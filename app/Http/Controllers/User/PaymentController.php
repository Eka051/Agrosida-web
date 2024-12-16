<?php

namespace App\Http\Controllers\User;

use App\Models\Shipment;
use Http;
use Midtrans\Snap;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Midtrans\Notification;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config as MidtransConfig;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PaymentController extends Controller
{
    use ValidatesRequests;
    public function __construct()
    {
        MidtransConfig::$serverKey = config('services.midtrans.server_key');
        MidtransConfig::$clientKey = config('services.midtrans.client_key');
        MidtransConfig::$isProduction = config('services.midtrans.is_production');
        MidtransConfig::$isSanitized = config('services.midtrans.is_sanitized');
    }

    public function process(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'shipping_option' => 'required|string',
            'address' => 'required|exists:addresses,id',
        ]);

        $fee = 2000;
        $product = Product::findOrFail($request->product_id);
        $subtotal = $product->price * $request->quantity;

        $shippingOption = explode('-', $request->shipping_option);
        $courierName = $shippingOption[0];
        $courierService = $shippingOption[1];
        $ongkir = (int) end($shippingOption);

        $total = $subtotal + $ongkir + $fee;

        if ($total <= 0) {
            return redirect()->back()->with('error', 'Total pembayaran tidak valid');
        }

        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Login terlebih dahulu');
        }

        $existingOrder = Order::where('user_id', $user->user_id)
            ->where('status', 'pending')
            ->whereHas('order_detail', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })
            ->first();

        if ($existingOrder) {
            return redirect()->back()->with('error', 'Anda sudah memiliki pesanan yang belum selesai untuk produk ini.');
        }

        $orderID = 'ORDER-' . Str::random(9);

        $payload = [
            'transaction_details' => [
                'order_id' => $orderID,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok produk tidak cukup');
        }

        try {
            $order = Order::create([
                'user_id' => $user->user_id,
                'order_id' => $orderID,
                'status' => 'processed',
            ]);

            OrderDetail::create([
                'order_id' => $order->order_id,
                'product_id' => $product->id,
                'product_name' => $product->product_name,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'total' => $subtotal,
            ]);

            $product->stock -= $request->quantity;
            $product->save();

            $address = $user->addresses()->findOrFail($request->address);

            $shipment = Shipment::create([
                'order_id' => $orderID,
                'status' => 'processing',
                'detail_address' => $address->getFullAddressAttribute(),
                'courier_name' => $courierName,
                'courier_service' => $courierService,
                'shipping_cost' => $ongkir,
            ]);

            $snapToken = Snap::getSnapToken($payload);

            $payment = Payment::create([
                'user_id' => $user->user_id,
                'order_id' => $orderID,
                'status' => 'pending',
                'total' => $total,
                'payment_type' => 'qris'
            ]);

            $order->update([
                'snap_token' => $snapToken,
                'payment_id' => $payment->id
            ]);

            return view('user.payment', compact('order', 'snapToken', 'total'));

        } catch (\Exception $e) {
            Log::error('Midtrans Payment Error: ' . $e->getMessage());

            if (isset($order)) {
                $order->delete();
            }

            if (isset($payment)) {
                $payment->delete();
            }

            return redirect()->back()->with('error', 'Gagal membuat pembayaran: ' . $e->getMessage());
        }
    }

    public function payPendingOrder($order_id)
    {
        $order = Order::with(['order_detail', 'shipment'])->where('order_id', $order_id)->where('status', 'processed')->first();

        if (!$order) {
            return redirect()->route('user.history')->with('error', 'Pesanan tidak ditemukan atau sudah dibayar.');
        }

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Login terlebih dahulu');
        }

        $payload = [
            'transaction_details' => [
                'order_id' => $order->order_id,
                'gross_amount' => $order->order_detail->sum('total') + $order->shipment->shipping_cost + 2000,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($payload);

            $order->update([
                'snap_token' => $snapToken,
            ]);

            $total = $order->order_detail->sum('total') + $order->shipment->shipping_cost + 2000;

            return view('user.payment', compact('order', 'snapToken', 'total'));

        } catch (\Exception $e) {
            Log::error('Midtrans Payment Error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Gagal membuat pembayaran: ' . $e->getMessage());
        }
    }

    public function cartPayment(Request $request)
    {
        $request->validate([
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
            'shipping_option' => 'required|string',
            'address' => 'required|exists:addresses,id',
        ]);

        $fee = 2000;
        $subtotal = 0;
        $products = Product::whereIn('id', $request->product_id)->get();

        foreach ($products as $product) {
            $quantity = $request->quantity[array_search($product->id, $request->product_id)];
            $subtotal += $product->price * $quantity;
        }

        $shippingOption = explode('-', $request->shipping_option);
        $courierName = $shippingOption[0];
        $courierService = $shippingOption[1];
        $ongkir = (int) end($shippingOption);

        $total = $subtotal + $ongkir + $fee;

        if ($total <= 0) {
            return redirect()->back()->with('error', 'Total pembayaran tidak valid');
        }

        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Login terlebih dahulu');
        }

        $existingOrder = Order::where('user_id', $user->user_id)
            ->where('status', 'processed')
            ->whereHas('order_detail', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })
            ->first();

        if ($existingOrder) {
            return redirect()->back()->with('error', 'Anda sudah memiliki pesanan yang belum selesai untuk produk ini.');
        }

        $orderID = 'ORDER-' . Str::random(9);

        $payload = [
            'transaction_details' => [
                'order_id' => $orderID,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        foreach ($products as $product) {
            $quantity = $request->quantity[array_search($product->id, $request->product_id)];
            if ($product->stock < $quantity) {
                return redirect()->back()->with('error', "Stok produk tidak cukup untuk {$product->product_name}");
            }
        }

        try {
            $order = Order::create([
                'user_id' => $user->user_id,
                'order_id' => $orderID,
                'status' => 'processed',
            ]);

            foreach ($products as $product) {
                $quantity = $request->quantity[array_search($product->id, $request->product_id)];
                OrderDetail::create([
                    'order_id' => $order->order_id,
                    'product_id' => $product->id,
                    'product_name' => $product->product_name,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'total' => $product->price * $quantity,
                ]);

                $product->stock -= $quantity;
                $product->save();
            }
            $address = $user->addresses()->findOrFail($request->address);

            $shipment = Shipment::create([
                'order_id' => $orderID,
                'status' => 'processing',
                'detail_address' => $address->getFullAddressAttribute(),
                'courier_name' => $courierName,
                'courier_service' => $courierService,
                'shipping_cost' => $ongkir,
            ]);

            $snapToken = Snap::getSnapToken($payload);

            $payment = Payment::create([
                'user_id' => $user->user_id,
                'order_id' => $orderID,
                'status' => 'pending',
                'total' => $total,
                'payment_type' => 'qris'
            ]);

            $order->update([
                'snap_token' => $snapToken,
                'payment_id' => $payment->id
            ]);

            $cart = Cart::where('user_id', $user->user_id);
            $cart->delete();

            return view('user.payment', compact('order', 'snapToken', 'total'));

        } catch (\Exception $e) {
            Log::error('Midtrans Payment Error: ' . $e->getMessage());

            if (isset($order)) {
                $order->delete();
            }

            if (isset($payment)) {
                $payment->delete();
            }

            return redirect()->back()->with('error', 'Gagal membuat pembayaran: ' . $e->getMessage());
        }
    }

    public function handleMidtransWebhook()
    {
        $notif = new Notification();
        $order = Order::with(['order_detail', 'shipment'])->where('order_id', $notif->order_id)->first();
    
        if (!$order) {
            return response()->json(['error' => 'Pesanan tidak ditemukan'], 404);
        }
    
        $allowedOrderStatuses = ['processed', 'shipped', 'canceled'];
        $allowedPaymentStatuses = ['pending', 'paid', 'failed', 'canceled'];
        $orderStatus = null;
        $paymentStatus = null;

        if ($notif->transaction_status == 'capture' && $notif->payment_type == 'credit_card') {
            $orderStatus = $notif->fraud_status == 'accept' ? 'processed' : 'canceled';
            $paymentStatus = $notif->fraud_status == 'accept' ? 'paid' : 'failed';
        } elseif ($notif->transaction_status == 'settlement') {
            $orderStatus = 'processed';
            $paymentStatus = 'paid';
        } elseif ($notif->transaction_status == 'pending') {
            $orderStatus = 'processed';
            $paymentStatus = 'pending';
        } elseif ($notif->transaction_status == 'deny') {
            $orderStatus = 'canceled';
            $paymentStatus = 'failed';
        } elseif ($notif->transaction_status == 'expire') {
            $orderStatus = 'canceled';
            $paymentStatus = 'failed';
        } elseif ($notif->transaction_status == 'cancel') {
            $orderStatus = 'canceled';
            $paymentStatus = 'canceled';
        }

        if ($orderStatus && in_array($orderStatus, $allowedOrderStatuses)) {
            $order->update(['status' => $orderStatus]);
        }

        if ($paymentStatus && in_array($paymentStatus, $allowedPaymentStatuses)) {
            Payment::where('order_id', $order->order_id)
                ->update(['status' => $paymentStatus]);
        }

        if ($orderStatus == 'processed' && $paymentStatus == 'paid') {
            $fee = 2000;
            foreach ($order->order_detail as $detail) {
                $subtotal = $detail->quantity * $detail->price;
                $product = Product::find($detail->product_id);
                $seller = User::find($product->created_by);

                if ($seller && $seller->hasRole('seller')) {
                    $seller->balance += $subtotal;
                    $seller->save();
                }

                $admin = User::all();
                foreach ($admin as $adm) {
                    if ($adm->hasRole('admin')) {
                        $adm->balance += $fee;
                        $adm->save();
                    }
                }
            }
        }
    
        return response()->json(['status' => 'Success']);
    }
}

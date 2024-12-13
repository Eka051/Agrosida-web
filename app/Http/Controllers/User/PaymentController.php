<?php

namespace App\Http\Controllers\User;

use Http;
use Midtrans\Snap;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Midtrans\Notification;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        MidtransConfig::$isSanitized = config('services.midtrans.is_sanitized');}

    public function process(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $ongkir = 20000;
        $fee = 2000;
        $product = Product::findOrFail($request->product_id);
        $subtotal = $product->price * $request->quantity;
        $total = $product->price * $request->quantity + $ongkir + $fee;

        if ($total <= 0) {
            return redirect()->back()->with('error', 'Total pembayaran tidak valid');
        }
        

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Login terlebih dahulu');
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
                'status' => 'pending',
            ]);
    
            OrderDetail::create([
                'order_id' => $order->order_id,
                'product_id' => $product->id,
                'product_name' => $product->product_name,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'total' => $subtotal,
            ]);

            $product = Product::find($request->product_id);
            $product->stock = $product->stock - $request->quantity;
            $product->save();
            $product->stock -= $request->quantity;
            $snapToken = Snap::getSnapToken($payload);
    
            $payment = Payment::create([
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

    public function cartPayment(Request $request)
    {
        $request->validate([
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
        ]);

        $ongkir = 20000;
        $fee = 2000;
        $subtotal = 0;
        $products = Product::whereIn('id', $request->product_id)->get();

        foreach ($products as $product) {
            $quantity = $request->quantity[array_search($product->id, $request->product_id)];
            $subtotal += $product->price * $quantity;
        }

        $total = $subtotal + $ongkir + $fee;

        if ($total <= 0) {
            return redirect()->back()->with('error', 'Total pembayaran tidak valid');
        }

        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Login terlebih dahulu');
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
                'status' => 'pending',
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

            $snapToken = Snap::getSnapToken($payload);

            $payment = Payment::create([
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
    

    public function handleMidtransWebhook()
    {
        $notif = new Notification();
        $order = Order::where('order_id', $notif->order_id)->first();
    
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
    
        $status = match(true) {
            $notif->transaction_status == 'capture' && $notif->payment_type == 'credit_card' => 
                $notif->fraud_status == 'accept' ? 'paid' : 'failed',
            $notif->transaction_status == 'settlement' => 'paid',
            $notif->transaction_status == 'pending' => 'pending',
            $notif->transaction_status == 'deny' => 'failed',
            $notif->transaction_status == 'expire' => 'cancelled',
            $notif->transaction_status == 'cancel' => 'cancelled',
            default => null
        };
    
        if ($status) {
            $order->update(['status' => $status]);
    
            Payment::where('order_id', $order->order_id)
                ->update(['status' => $notif->transaction_status]);
        }
    
        return response()->json(['status' => 'Success']);
    }

}
<?php

namespace App\Http\Controllers\User;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }
    public function order($id){
        $product = Product::find($id);
        $addresses = Auth::user()->addresses;
        return view('user.order', compact('product', 'addresses'));

    }

    public function showOrderFromUser() {
        return view('seller.pesananSeller');
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to place an order.');
        }
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // dd($validated);

        $product = Product::findOrFail($request->product_id);
        $total = $product->price * $request->quantity + 20000; // Tambahkan ongkir

        $payment = Payment::create([
            'name' => 'qris',
            'total' => $total,
        ]);
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to place an order.');
        }

        $order = Order::create([
            'user_id' => $user->user_id,
            'status' => 'pending',
            'payment_id' => $payment->payment_id,
        ]);

        // Simpan detail order
        $orderDetail = new OrderDetail();
        $orderDetail->order_id = $order->order_id;
        $orderDetail->product_id = $product->id;
        $orderDetail->product_name = $product->product_name;
        $orderDetail->quantity = $request->quantity;
        $orderDetail->price = $product->price;
        $orderDetail->total = $total;
        $orderDetail->save();

        // Payload untuk Midtrans
        $payload = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $total
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'item_details' => [
                [
                    'id' => $product->id,
                    'price' => $product->price,
                    'quantity' => $request->quantity,
                    'name' => $product->product_name
                ]
            ]
        ];
        // Set Midtrans configuration
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Generate Snap Token
        // Generate Snap Token
        $snapToken = Snap::getSnapToken($payload);

        return view('user.payment', compact('order', 'snapToken'));
    }
}

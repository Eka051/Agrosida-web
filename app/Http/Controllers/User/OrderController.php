<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return view('user.order');
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'address' => $request->address,
            'phone' => $request->phone,
            'status' => 'Menunggu Pembayaran',
        ]);

        foreach (Cart::where('user_id', Auth::id())->get() as $cart) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('user.order')->with('success', 'Pesanan berhasil dibuat');
    }
}

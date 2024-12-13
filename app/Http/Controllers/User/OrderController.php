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
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function order($id)
    {
        $product = Product::find($id);
        $addresses = Auth::user()->addresses;
        return view('user.order', compact('product', 'addresses'));
    }

    public function showOrderFromUser()
    {
        $orders = Order::with('order_detail', 'user', 'payment')->get();
        return view('seller.pesananSeller', compact('orders'));
    }

    public function showOrderDetail($id)
    {
        $order_detail = OrderDetail::with('order', 'product')->where('order_id', $id)->get();
        return view('seller.order-detail', compact('order_detail'));
    }

    public function orderDetail($id)
    {
        $order = Order::with('order_detail', 'user', 'payment')->where('order_id', $id)->first();
        return view('user.order-detail', compact('order'));
    }

    public function history()
    {
        $orders = Order::with('order_detail', 'user', 'payment')->where('user_id', Auth::user()->user_id)->get();
        return view('user.riwayatPesananUser', compact('orders'));
    }
    
}

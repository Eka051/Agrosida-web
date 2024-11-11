<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
       $cart = Cart::with(['product', 'user'])->where('user_id', Auth::user()->id)->get();
       return view('user.cart', compact('cart'));
    }


    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);
         
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->where('product_id', $request->product_id)->first();
        if ($cart) {
            $cart->update(['quantity' => $cart->quantity + 1]);
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'quantity' => 1
            ]);
            Session::flash('success', __('Product added to cart'));
        }
        return redirect()->route('cart');
    }

    public function remove(Request $request)
    {
        Cart::destroy($request->id);
        Session::flash('success', 'Produk dihapus dari keranjang');
        return redirect()->route('cart');
    }
}

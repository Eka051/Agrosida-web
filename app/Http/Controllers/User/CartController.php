<?php

namespace App\Http\Controllers\User;

use Log;
use Exception;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', auth()->user()->user_id)->with('product', 'user')->get();
        return view('user.keranjang', compact('carts'));
    }


    public function add($product_id)
    {
        $product = Product::find($product_id);
        if (!$product) {
            return redirect()->route('user.cart')->with('error', 'Produk tidak ditemukan');
        }
        $userId = auth()->user()->user_id;
        $cart = Cart::where('user_id', $userId)->where('product_id', $product_id)->first();
        if ($cart) {
            $cart->update(['quantity' => $cart->quantity + 1]);
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $product_id,
                'quantity' => 1
            ]);
        }
        Session::flash('success', 'Produk ditambahkan ke keranjang');
        return redirect()->route('user.dashboard');
    }
    
    public function remove($product_id)
    {
        Cart::where('product_id', $product_id)->delete();
        return redirect()->route('user.cart')
            ->with('success', 'Produk dihapus dari keranjang');
    }

    public function checkout()
    {
        $userId = auth()->user()->user_id;
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Keranjang kosong');
        }
        $addresses = Address::where('user_id', $userId)->get();

        return view('user.cart-checkout', compact('cartItems', 'addresses'));
    }

    public function clearCartAfterPayment($user_id)
    {
        Cart::where('user_id', $user_id)->delete();
    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'cart_items' => 'required|array',
            'cart_items.*.product_id' => 'required|exists:products,id',
            'cart_items.*.quantity' => 'required|integer|min:1',
        ]);
    
        $userId = auth()->id();
    
        DB::beginTransaction();
        try {
            $updatedCartItems = [];
            foreach ($request->cart_items as $item) {
                $product = Product::findOrFail($item['product_id']);
    
                if ($item['quantity'] > $product->stock) {
                    return response()->json([
                        'message' => "Stok untuk {$product->product_name} tidak mencukupi.",
                    ], 422);
                }
    
                $cart = Cart::where('product_id', $item['product_id'])
                            ->where('user_id', $userId)
                            ->firstOrFail();
    
                $cart->quantity = $item['quantity'];
                $cart->save();
    
                $updatedCartItems[] = [
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'subtotal' => $cart->quantity * $cart->product->price,
                ];
            }
    
            DB::commit();
    
            return response()->json([
                'message' => 'Kuantitas berhasil diperbarui.',
                'cart_items' => $updatedCartItems,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    
    
    
}

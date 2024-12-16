<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

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
        return view('user.cart-checkout', compact('cartItems'));
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
        ]);

        $userId = auth()->user()->user_id;
    
        DB::beginTransaction();
        try {
            $updatedCartItems = [];
            $totalCart = 0;
    
            foreach ($request->input('cart_items', []) as $cartItemData) {
                $cartItem = Cart::where('product_id', $cartItemData['product_id'])
                    ->where('user_id', $userId)
                    ->first();
    
                if (!$cartItem) {
                    continue;
                }
    
                $cartItem->quantity = $cartItemData['quantity'];
                $cartItem->save();
    
                $subtotal = $cartItem->product->price * $cartItem->quantity;
                $totalCart += $subtotal;
    
                $updatedCartItems[] = [
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'subtotal' => number_format($subtotal, 0, ',', '.')
                ];
            }
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'cart_items' => $updatedCartItems,
                'total' => number_format($totalCart, 0, ',', '.'),
                'cart_count' => count($updatedCartItems),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Cart Update Error: ' . $e->getMessage());
    
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate keranjang',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    
}

<?php

namespace App\Http\Controllers\Seller;

use App\Models\Product;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $products = Product::whereHas('user', function ($query) use ($user) {
            $query->where('user_id', $user->user_id);
        })
        ->with(['user.store', 'category'])
        ->where('discontinued', 0)
        ->get();
        return view('seller.sellerDashboard', compact('products'));

    }

    public function showOrder()
    {
        return view('seller.pesananSeller');
    }

    public function showTransaction()
    {
        return view('seller.transaksiSeller');
    }
}

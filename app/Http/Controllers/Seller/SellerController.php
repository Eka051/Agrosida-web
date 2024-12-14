<?php

namespace App\Http\Controllers\Seller;

use Auth;
use App\Models\Address;
use App\Models\Product;
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

    public function profile()
    {
        $user = auth()->user();
        $address = Address::where('user_id', $user->id)
            ->with('province', 'city', 'user')
            ->first();
        return view('user.profile-user', compact('user', 'address'));
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

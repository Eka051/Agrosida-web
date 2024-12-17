<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $products = Product::with('category', 'user.store')
            ->where('discontinued', 0)
            ->get();
            
        $sold = OrderDetail::whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                    ->where('status', 'paid');
        })
        ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('product_id')
        ->pluck('total_quantity', 'product_id');
        // dd($sold);

            
    
        return view('user.userDashboard', compact('user', 'products', 'sold'));
    }
    public function orderProduct($id)
    {
        $product = Product::find($id);
        $order = Order::with('order_detail')->where('user_id', auth()->user()->id)->get();

        return view('user.order', compact('product'));
    }

    public function profile()
    {
        $user = auth()->user();
        $address = Address::where('user_id', $user->id)
            ->with('province', 'city', 'user')
            ->first();
        $addresses = $address->getFullAddressAttribute();
        return view('user.profile-user', compact('user', 'addresses'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find($request->user_id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('user.userDashboard')->with('success', 'Profil berhasil diubah');
    }
}
<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $products = Product::with('category', 'user.store')
            ->where('discontinued', 0)
            ->get();
        return view('user.userDashboard', compact('user', 'products'));
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

    public function editProfile(Request $request)
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
<?php

namespace App\Http\Controllers\User;

use App\Models\User;
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
        return view('user.order', compact('product'));
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

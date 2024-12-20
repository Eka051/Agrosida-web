<?php

namespace App\Http\Controllers\User;

use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use App\Models\Province;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

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

    public function profileUser()
    {
        $user = auth()->user();
        $address = Address::where('user_id', $user->user_id)
            ->with('province', 'city', 'user')
            ->first();
        $addresses = $address->getFullAddressAttribute() ?? null;
        return view('user.profile-user', compact('user', 'addresses'));
    }
    
    public function updateProfileUser(Request $request)
    {
        $user = User::find($request->user_id);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('profile-user')->with('success', 'Profil berhasil diubah');
    }

    public function editProfile($user_id)
    {
        $user = User::find($user_id);
        return view('user.editProfile', compact('user'));
    }
}
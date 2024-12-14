<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function registerUser()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
       $request->validate([
           'name' => 'required',
           'email' => 'required|email|unique:users',
           'username' => 'required|string|unique:users',
           'password' => 'required|min:8|confirmed',
       ]);

       if (User::where('email', $request->email)->exists() || User::where('username', $request->username)->exists()) {
            return redirect()->back()->withErrors(['error' => 'Akun dengan email atau username tersebut sudah ada.']);
        }

       $user = User::create([
            'user_id' => Str::uuid(),
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
       ]);
       $user->assignRole('user');


       return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silahkan login!');
    }

    public function storeSeller(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|unique:stores,name',
            'name' => 'required',
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        if (User::where('email', $request->email)->exists() || User::where('username', $request->username)->exists()) {
            return redirect()->back()->withErrors(['error' => 'Akun dengan email atau username tersebut sudah ada.']);
        }

        $seller = User::create([
            'user_id' => Str::uuid(),
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $seller->assignRole('seller');

        Store::create([
            'name' => $request->store_name,
            'user_id' => $seller->user_id,
        ]);

        return redirect()->route('login')->with('success', 'Akun Seller berhasil dibuat');
    }
}

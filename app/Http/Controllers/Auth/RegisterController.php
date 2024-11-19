<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
       $request->validate([
           'name' => 'required',
           'username' => 'required|unique:users',
           'email' => 'required|email',
           'password' => 'required|min:8|confirmed',
       ]);

       User::create([
            'user_id' => Str::uuid(),
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 2,
       ]);

       return redirect()->route('login')->with('success', 'Akun berhasil dibuat');
    }
}

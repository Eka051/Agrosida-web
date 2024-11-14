<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }


    public function authenticate(Request $request) 
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if(Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('admin/dashboard')->with('success', 'Login berhasil');
        }

        if(Auth::attempt($credentials, $request->filled('remember'))) {
           $request->session()->regenerate();

           return redirect()->intended('dashboard')->with('success', 'Login berhasil');
        }

        return back()->withErrors([ 
            'email' => 'Akun tidak ditemukan',
        ])->onlyInput('email');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


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
       ]);

       return redirect()->route('login')->with('success', 'Akun berhasil dibuat');
    }
}

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
        $input = $request->input('login');

        $request->validate([
            'login' => 'required',
            'password' => 'required|min:8',
        ]);
        $loginType = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $input,
            'password' => $request->password,
        ];

        if(Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            $user = User::user();

            if($user->isAdmin()) {
                return redirect()->intended('admin/dashboard')->with('success', 'Login berhasil');
            } elseif ($user->isSeller()) {
                return redirect()->intended('seller/dashboard')->with('success', 'Login berhasil');
            } else {
                return redirect()->intended('user/dashboard')->with('success', 'Login berhasil');
            }
        }

        return back()->withErrors([
            'email' => 'Data yang dimasukkan tidak sesuai',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}

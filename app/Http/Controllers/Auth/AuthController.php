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
            $user = Auth::user();

            if($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil');
            } elseif ($user->hasRole('seller')) {
                return redirect()->route('seller.dashboard')->with('success', 'Login berhasil');
            } else {
                return redirect()->route('user.dashboard')->with('success', 'Login berhasil');
            }
            }

        return back()->withErrors([
            'login' => 'Data yang dimasukkan tidak sesuai',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}

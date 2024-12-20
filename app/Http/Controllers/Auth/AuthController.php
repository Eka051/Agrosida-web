<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            'password' => 'required|string',
        ]);

        if (trim($credentials['username']) === '' || trim($credentials['password']) === '') {
            return redirect()->route('login')->with('error', 'Form tidak boleh berisi spasi atau kosong');
        }

        $loginType = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $attempt = [
            $loginType => $credentials['username'],
            'password' => $credentials['password'],
        ];

        if (Auth::attempt($attempt)) {
            $request->session()->regenerate();

            $user = Auth::user();
           
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard')->with('success', "Login Berhasil. \n Selamat datang, $user->name");
            } elseif ($user->hasRole('seller')) {
                if ($user->addresses()->count() == 0) {
                    return redirect()->route('profile-seller', compact('user'))->with('warning', 'Isi alamat toko terlebih dahulu');
                }
                return redirect()->route('seller.dashboard')->with('success', "Berhasil. \n Selamat datang, $user->name");
            } else {
                return redirect()->route('user.dashboard')->with('success', "Berhasil. \n Selamat datang, $user->name");
            }
        }

        return redirect()->route('login')->with('error', 'Username atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}

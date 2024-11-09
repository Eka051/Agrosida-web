<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class AuthController extends Controller
{
    public function register(Request $request)
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

       Auth::create([
           'name' => $request->name,
           'username' => $request->username,
           'email' => $request->email,
           'password' => bcrypt($request->password),
       ]);

       return redirect()->route('login')->with('success', 'Akun berhasil dibuat');
    }

    public function autenthicate(Request $request) 
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

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('gauth_id', $user->id)->first();

            if ($findUser) {
                Auth::login($findUser);

                return redirect('/dashboard');

                if ($findUser->isAdmin()) {
                    return redirect('/admin/dashboard');
                } elseif ($findUser->isSeller()) {
                    return redirect('/seller/dashboard');
                } else {
                    return redirect('/dashboard');
                }

            } else {
                $newUser = new User([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id' => $user->id,
                    'gauth_type' => 'google',
                    'password' => bcrypt('password'),
                ]);

                $newUser->save();

                Auth::login($newUser);

                return redirect('/dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}

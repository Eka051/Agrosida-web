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
           'username' => 'required|string|unique:users',
           'password' => 'required|min:8|confirmed',
       ]);

        $data = $request->all();

        if (filter_var($data['username'], FILTER_VALIDATE_EMAIL)) {
            $data['email'] = $data['username'];
            $data['username'] = null;
        } else {
            $data['email'] = null;
        }


       $user = User::create([
            'user_id' => Str::uuid(),
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
       ]);
       $user->assignRole('user');


       return redirect()->route('login')->with('success', 'Akun berhasil dibuat');
    }
}

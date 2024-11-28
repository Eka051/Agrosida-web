<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $name = auth()->user()->name;
        return view('user.userDashboard')->with('name', $name);
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

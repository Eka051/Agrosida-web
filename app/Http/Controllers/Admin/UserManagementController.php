<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.kelolaPengguna', compact('users'));
    }

    public function deleteUser($user_id)
    {
        $user = User::where('user_id', $user_id)->first();

        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User berhasil dihapus');
        }

        return redirect()->back()->with('error', 'User tidak ditemukan');
    }
}

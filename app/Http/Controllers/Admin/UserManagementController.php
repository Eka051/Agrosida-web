<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserManagementController extends Controller
{
    public function index()
    {
        return view('admin.UserManagement');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User berhasil dihapus');
        }
    }
}

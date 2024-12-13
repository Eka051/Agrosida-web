<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function index()
    {
        $totalProduct = Product::count();
        $totalOrder = Order::count();
        $balance = User::where('username', 'admin')->sum('balance');
        return view('admin.adminDashboard', compact('totalProduct', 'totalOrder', 'balance'));
    }
    
}

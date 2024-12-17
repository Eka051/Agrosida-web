<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderDetail;
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
        $admin = User::where('username', 'admin')->first();
        $balance = $admin->balance;
        $totalCustomer = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->count();

        $orderData = Order::selectRaw('COUNT(*) as total_orders, MONTH(created_at) as month')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total_orders', 'month')
            ->toArray();

        $balanceData = User::whereHas('roles', function($query) {
                $query->where('name', 'admin');
            })
            ->selectRaw('SUM(balance) as total_balance, MONTH(created_at) as month')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total_balance', 'month')
            ->toArray();

        $productData = Product::selectRaw('COUNT(*) as total_products, MONTH(created_at) as month')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total_products', 'month')
            ->toArray();

        $customerData = Order::selectRaw('COUNT(DISTINCT user_id) as total_customers, MONTH(created_at) as month')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total_customers', 'month')
            ->toArray();

        $months = range(1, 12);
        $formattedOrderData = [];
        $formattedBalanceData = [];
        $formattedProductData = [];
        $formattedCustomerData = [];

        foreach ($months as $month) {
            $formattedOrderData[] = $orderData[$month] ?? 0;
            $formattedBalanceData[] = $balanceData[$month] ?? 0;
            $formattedProductData[] = $productData[$month] ?? 0;
            $formattedCustomerData[] = $customerData[$month] ?? 0;
        }

        return view('admin.adminDashboard', compact(
            'totalProduct',
            'totalOrder',
            'balance',
            'formattedOrderData',
            'formattedBalanceData',
            'formattedProductData',
            'formattedCustomerData',
            'months',
            'totalCustomer'
        ));
    }

    public function profile()
    {
        $admin = User::where('username', 'admin')->first();
        return view('admin.profile', compact('admin'));
    }
    
}

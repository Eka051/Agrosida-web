<?php

namespace App\Http\Controllers\Seller;

use App\Models\OrderDetail;
use Auth;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalProduct = Product::where('created_by', $user->user_id)->count();
        $totalOrder = Order::whereHas('order_detail.product', function ($query) use ($user) {
            $query->where('created_by', $user->user_id);
        })->count();
        $balance = $user->balance;
        $totalCustomer = Order::whereHas('order_detail.product', function ($query) use ($user) {
            $query->where('created_by', $user->user_id);
        })->distinct('user_id')->count('user_id');

        $incomeData = Order::join('order_details', 'orders.order_id', '=', 'order_details.order_id')
            ->selectRaw('SUM(order_details.total) as total_income, MONTH(orders.created_at) as month')
            ->where('orders.status', 'paid')
            ->whereHas('order_detail.product', function ($query) use ($user) {
            $query->where('created_by', $user->user_id);
            })
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total_income', 'month');

        $orderData = Order::selectRaw('COUNT(order_id) as total_orders, MONTH(created_at) as month')
            ->whereHas('order_detail.product', function ($query) use ($user) {
                $query->where('created_by', $user->user_id);
            })
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total_orders', 'month');

        $categories = range(1, 12);
        $formattedIncomeData = [];
        $formattedOrderData = [];

        foreach ($categories as $month) {
            $formattedIncomeData[] = $incomeData[$month] ?? 0;
            $formattedOrderData[] = $orderData[$month] ?? 0;
        }

        return view('seller.sellerDashboard', compact(
            'totalProduct',
            'totalOrder',
            'balance',
            'formattedIncomeData',
            'formattedOrderData',
            'categories',
            'totalCustomer'
        ));
    }

    public function profile()
    {
        $user = auth()->user();
        $address = Address::where('user_id', $user->id)
            ->with('province', 'city', 'user')
            ->first();
        return view('user.profile-user', compact('user', 'address'));
    }

    public function showOrder()
    {
        return view('seller.pesananSeller');
    }

    
}

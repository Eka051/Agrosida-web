<?php

namespace App\Http\Controllers\Seller;

use Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Http\Request;
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

    public function profileSeller()
    {
        $user = auth()->user();
        $address = Address::where('user_id', $user->user_id)
            ->with('province', 'city', 'user')
            ->first();
        $addresses = $address->getFullAddressAttribute() ?? null;
        return view('seller.profile-seller', compact('user', 'addresses'));
    }

    public function editProfileSeller($user_id)
    {
        $user = User::find($user_id);
        return view('seller.editProfile', compact('user'));
    }

    public function updateProfileSeller(Request $request)
    {
        $user = User::find($request->user_id);
        
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        
        return redirect()->route('admida')->with('success', 'Profil berhasil diubah');
    }

}

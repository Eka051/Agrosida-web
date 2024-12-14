<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function order($id)
    {
        $product = Product::find($id);
        $addresses = Address::where('user_id', Auth::user()->user_id)->get();
        return view('user.order', compact('product', 'addresses'));
    }

    public function getShipCost(Request $request)
    {
        $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'weight' => 'required|numeric',
            'courier' => 'required'
        ]);

        $response = Http::withHeaders([
            'key' => config('services.rajaongkir.api_key'),
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $request->origin,
            'destination' => $request->destination,
            'weight' => $request->weight,
            'courier' => $request->courier,
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Failed to fetch shipping cost'], 500);
    }

    public function getCourier(Request $request)
    {
        $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'weight' => 'required|numeric',
        ]);

        $origin = $request->origin;
        $destination = $request->destination;
        $weight = $request->weight * 1000;
        $couriers = ['jne', 'pos', 'tiki'];

        $response = [];
        foreach ($couriers as $courier) {
            $response[$courier] = $this->getCost($origin, $destination, $weight, $courier);
        }

        return response()->json($response);
    }

    public function showOrderFromUser()
    {
        $orders = Order::with('order_detail', 'user', 'payment')->get();
        return view('seller.pesananSeller', compact('orders'));
    }

    public function showOrderDetail($id)
    {
        $order_detail = OrderDetail::with('order', 'product')->where('order_id', $id)->get();
        return view('seller.order-detail', compact('order_detail'));
    }

    public function orderDetail($id)
    {
        $order = Order::with('order_detail', 'user', 'payment')->where('order_id', $id)->first();
        return view('user.order-detail', compact('order'));
    }

    public function history()
    {
        $orders = Order::with('order_detail', 'user', 'payment')->where('user_id', Auth::user()->user_id)->get();
        return view('user.riwayatPesananUser', compact('orders'));
    }
    
}

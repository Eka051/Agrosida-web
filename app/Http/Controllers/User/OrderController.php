<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function order($id)
    {
        $product = Product::with('category', 'user.addresses.city')->find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $addresses = Address::where('user_id', auth()->user()->user_id)->get();

        return view('user.order', compact('product', 'addresses'));
    }

    public function getShippingCost(Request $request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $weight = $request->input('weight');
        $courier = $request->input('courier');

        try {
            $response = Http::withHeaders([
                'key' => config('services.rajaongkir.api_key'),
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier,
            ]);

            $data = $response->json();
            if ($response->successful()) {
                if (isset($data['rajaongkir']['results'][0]['costs'])) {
                    return response()->json(['costs' => $data['rajaongkir']['results'][0]['costs']]);
                }
            } elseif ($response->status() === 400 && isset($data['rajaongkir']['status']['description'])) {
                $error = $data['rajaongkir']['status']['description'];
                Log::error('Shipping cost error: ' . $error);
                return response()->json(['error' => $error], 400);
            }
        } catch (\Exception $e) {
            Log::error('Shipping cost error: ' . $e->getMessage());
        }

        return response()->json(['error' => 'Unable to fetch shipping cost'], 500);
    }

    public function getCourier(Request $request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $weight = $request->input('weight');

        if (!$origin || !$destination || !$weight) {
            return response()->json([
                'status' => 'error',
                'message' => 'Missing required parameters'
            ], 400);
        }
        
        $couriers = ['jne', 'pos', 'tiki'];
        $response = [];
    
        foreach ($couriers as $courier) {
            $costs = $this->getShippingCostFromAPI($origin, $destination, $weight, $courier);
            if (!empty($costs)) {
                foreach ($costs as $cost) {
                    if (isset($cost['cost'][0])) {
                        $response[] = [
                            'courier' => strtoupper($courier),
                            'service' => $cost['service'],
                            'description' => $cost['description'] ?? 'N/A',
                            'cost' => $cost['cost'][0]['value'] ?? 0,
                            'etd' => $cost['cost'][0]['etd'] ?? 'N/A',
                        ];
                    }
                }
            }
        }
    
        if (empty($response)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No shipping costs available for any couriers'
            ], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $response
        ], 200);
        
    }
    
    private function getShippingCostFromAPI($origin, $destination, $weight, $courier)
    {
        try {
            $response = Http::withHeaders([
                'key' => config('services.rajaongkir.api_key'),
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier,
            ]);
    
            $data = $response->json();
            Log::info('RajaOngkir response:', ['response' => $data]);
    
            if ($response->successful() && isset($data['rajaongkir'])) {
                $results = $data['rajaongkir']['results'] ?? [];
    
                if (!empty($results[0]['costs'])) {
                    return $results[0]['costs'];
                } else {
                    Log::warning("No shipping costs available for courier: {$courier}", ['results' => $results]);
                }
            } else {
                $status = $data['rajaongkir']['status'] ?? null;
                Log::error('RajaOngkir API Error', ['status' => $status]);
            }
        } catch (\Exception $e) {
            Log::error('Shipping cost error: ' . $e->getMessage());
        }
    
        return [];
    }
    
    public function showOrderFromUser()
    {
        $orders = Order::with(['order_detail', 'user', 'payment'])->get();
        return view('seller.pesananSeller', compact('orders'));
    }

    public function showOrderDetail($id)
    {
        $order = Order::with('order_detail', 'user', 'payment', 'shipment')->find($id);
        if (!$order) {
            return redirect()->back()->with('error', 'Order details not found');
        }
        return view('seller.order-detail', compact('order'));
    }

    public function orderDetail($id)
    {
        $order = Order::with('order_detail', 'user', 'payment', 'shipment')->find($id);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }

        return view('user.order-detail', compact('order'));
    }

    public function cancelOrder(Request $request)
    {
        $order = Order::with('order_detail', 'user', 'shipment')->find($request->input('order_id'));
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        } elseif ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Order cannot be canceled');
        } else {
            $order->status = 'canceled';
            $order->save();

            if ($order->shipment) {
                $order->shipment->status = 'canceled';
                $order->shipment->save();
            }

            $refundAmount = 0;
            foreach ($order->order_detail as $detail) {
                $refundAmount += $detail->price * $detail->quantity;
            }

            $user = $order->user;
            $user->balance += $refundAmount;
            $user->save();

            foreach ($order->order_detail as $detail) {
                $product = Product::find($detail->product_id);
                if ($product) {
                    $seller = $product->created_by ? User::find($product->created_by) : null;
                    if ($seller) {
                        $seller->balance -= $detail->price * $detail->quantity;
                        $seller->save();
                    }
                }
            }

            return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan dan pembayaran akan dikembalikan');
        }
    }

    public function history()
    {
        $orders = Order::with('order_detail', 'user', 'payment', 'shipment')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        $service_charge = 2000;
        $order_totals = [];

        foreach ($orders as $order) {
            $order_total = 0;
            foreach ($order->order_detail as $detail) {
                $order_total += $detail->price * $detail->quantity;
            }
            $order_total += ($order->shipment->shipping_cost ?? 0) + $service_charge;
            $order_totals[$order->order_id] = $order_total;
        }

        return view('user.riwayatPesananUser', compact('orders', 'order_totals'));
    }
}

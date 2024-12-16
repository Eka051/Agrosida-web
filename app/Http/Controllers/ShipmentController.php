<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShipmentController extends Controller
{
    public function confirmShipment(Request $request)
    {
        $shipment = Shipment::with('order')->find($request->input('order_id'));

        try {
            if ($shipment && $shipment->status === 'shipped') {
                $shipment->status = 'delivered';
                $shipment->save();

                $order = Order::with('shipment')->where('order_id', $shipment->order_id)->first();
                $order->status = 'shipped';
                $order->save();
                return redirect()->back()->with('success', 'Pesanan berhasil dikonfirmasi');
            }
        } catch (\Exception $e) {
            Log::error('Konfirmasi pesanan eror: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Pesanan tidak dapat dikonfirmasi');
        }
    }

}

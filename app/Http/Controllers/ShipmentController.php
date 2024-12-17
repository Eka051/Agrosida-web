<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShipmentController extends Controller
{
    public function confirmShipment($order_id) {
        $shipment = Shipment::with('order')->where('order_id', $order_id)->first();
        
        try {
            if ($shipment && $shipment->status === 'processing') {
                $shipment->status = 'delivered';
                $shipment->save();

                $order = Order::find($shipment->order_id);
                $order->status = 'shipped';
                $order->save();

                return redirect()->back()->with('success', 'Pesanan berhasil dikirim');
            }

            return redirect()->back()->with('error', 'Pesanan tidak ditemukan atau sudah dikirim');
        } catch (\Exception $e) {
            Log::error('Pengiriman pesanan eror: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Pesanan tidak dapat dikirim');
        }
    }

}

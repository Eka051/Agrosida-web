<?php

namespace App\Http\Controllers\User;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Midtrans\Config as MidtransConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Midtrans\CoreApi;

class PaymentController extends Controller
{
    use ValidatesRequests;
    public function __construct()
    {
        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');
        MidtransConfig::$isSanitized = config('midtrans.is_sanitized');
        MidtransConfig::$is3ds = config('midtrans.is_3ds');
    }

    public function process(Request $request)
    {
        $this->validate($request, [
            'order_id' => 'required|exists:orders,id',
            'payment' => 'required|in:bank_transfer,gopay,qris'
        ]);

        $order = DB::table('orders')
            ->select('orders.*', 'users.email')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where('orders.id', $request->order_id)
            ->first();

        if ($order->status != 'Menunggu Pembayaran') {
            return redirect()->back()->with('error', 'Pesanan sudah dibayar');
        }

        $payload = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total_price
            ],
            'customer_details' => [
                'first_name' => $order->name,
                'email' => $order->email,
                'phone' => $order->phone
            ],
            'item_details' => []
        ];

        $items = DB::table('order_details')
            ->select('products.title', 'order_details.quantity', 'order_details.price')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->where('order_details.order_id', $order->id)
            ->get();

        foreach ($items as $item) {
            $payload['item_details'][] = [
                'id' => $item->title,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'name' => $item->title
            ];
        }

        $payload = json_decode(json_encode($payload));

        if ($request->payment == 'bank_transfer') {
            $snapToken = \Midtrans\Snap::getSnapToken($payload);
            return view('user.payment.bank-transfer', compact('order', 'snapToken'));
        } elseif ($request->payment == 'gopay') {
            return view('user.payment.gopay', compact('order'));
        } elseif ($request->payment == 'qris') {
            $payload->payment_type = 'qris';
            $qrisResponse = CoreApi::charge($payload);
            $qrisUrl = $qrisResponse->actions[0]->url;
            return view('user.payment.qris', compact('order', 'qrisUrl'));
        }
    }

    public function handleWebHook()
    {
        $notification = new \Midtrans\Notification();
        $transaction = $notification->transaction_status;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        if ($transaction == 'capture') {
            if ($fraud == 'challenge') {
                DB::table('orders')->where('order_id', $order_id)->update(['status' => 'pending']);
            } else {
                DB::table('orders')->where('order_id', $order_id)->update(['status' => 'completed']);
            }
        } elseif ($transaction == 'settlement') {
            DB::table('orders')->where('order_id', $order_id)->update(['status' => 'completed']);
        } elseif ($transaction == 'pending') {
            DB::table('orders')->where('order_id', $order_id)->update(['status' => 'pending']);
        } elseif ($transaction == 'deny') {
            DB::table('orders')->where('order_id', $order_id)->update(['status' => 'cancelled']);
        } elseif ($transaction == 'expire') {
            DB::table('orders')->where('order_id', $order_id)->update(['status' => 'cancelled']);
        } elseif ($transaction == 'cancel') {
            DB::table('orders')->where('order_id', $order_id)->update(['status' => 'cancelled']);
        }
    }

}

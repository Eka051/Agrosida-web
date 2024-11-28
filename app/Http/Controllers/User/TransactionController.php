<?php

namespace App\Http\Controllers\User;

use Midtrans\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function processPayment(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Config::$is3ds = env('MIDTRANS_IS_3DS');

        $transaction_details = [
            'order_id' => $request->order_id,
            'gross_amount' => $request->input('total_harga'),
        ];
    }

    public function notificationHandler(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload);

        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraud = $notification->fraud_status;

        return response()->json([
            'transaction' => $transaction,
            'type' => $type,
            'orderId' => $orderId,
            'fraud' => $fraud,
        ]);
    }

    public function finishRedirect()
    {
        return redirect()->route('user.transaction.index')->with('success', 'Payment success');
    }
}

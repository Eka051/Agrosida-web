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
}

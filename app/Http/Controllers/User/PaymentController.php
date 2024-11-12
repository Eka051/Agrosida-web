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


}

<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        //
        'order/*',
        '/webhook/midtrans',
        '/get-cities',
        '/get-provinces',
        '/order/get-courier',
        '/send-code',
        'cart/update-quantity',
    ];
}

<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
   public function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}

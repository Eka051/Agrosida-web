<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        if (!Auth::user()) {
            return redirect()->route('login')->with('error', 'You are not authorized to access this page');
        }

        Log::info('User ID ' . Auth::user()->user_id . ' mengakses halaman ' . $request->fullUrl() . ' Role: ' . Auth::user()->hasRole($roles));

        if(!Auth::user()->hasRole($roles)) {
            abort(403, 'Tidak diizinkan untuk mengakses halaman ini');
        }

        return $next($request);
    }
}

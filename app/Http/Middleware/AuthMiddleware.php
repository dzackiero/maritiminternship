<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('user_id')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}

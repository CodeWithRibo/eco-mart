<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isRiderMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'rider') {
            return $next($request);
        }
        abort(404);
    }
}

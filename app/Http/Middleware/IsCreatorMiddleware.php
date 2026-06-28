<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsCreatorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || (auth()->user()->role !== 'creator' && auth()->user()->role !== 'admin')) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}

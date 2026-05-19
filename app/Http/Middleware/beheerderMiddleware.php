<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BeheerderMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role !== 'beheerder') {
            abort(403);
        }

        return $next($request);
    }
}

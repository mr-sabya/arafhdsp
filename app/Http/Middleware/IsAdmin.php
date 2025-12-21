<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in and is admin
        if (!Auth::check() || Auth::user()->is_admin != 1) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}

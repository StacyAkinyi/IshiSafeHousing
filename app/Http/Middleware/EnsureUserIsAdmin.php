<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Check if the user is logged in AND their role is 'admin'.
        if (auth()->check() && auth()->user()->role === 'admin') {
            // If they are an admin, allow the request to continue to the controller.
            return $next($request);
        }
        abort(403, 'Unauthorized Action.');

    }
}

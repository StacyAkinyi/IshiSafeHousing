<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Check2FA
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()&& !Auth::user()->two_factor_confirmed_at) {
            // Check if the user has 2FA enabled but not confirmed
            return redirect('/2fa')->with ('message', 'Please verify your two-factor authentication'); // Redirect to the 2FA page
        }
        return $next($request);
    }
}

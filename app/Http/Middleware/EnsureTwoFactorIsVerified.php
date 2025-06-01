<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureTwoFactorIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return $next($request); // Not logged in
        }

        // If user has no 2FA enabled or confirmed yet → redirect to setup
        if (!$user->two_factor_secret || !$user->two_factor_confirmed_at) {
            if ($request->route()->getName() !== '2fa.setup') {
                return redirect()->route('2fa.setup');
            }
        }

        // If 2FA is enabled but not passed yet in this session → redirect to challenge
        if ($user->two_factor_secret && $user->two_factor_confirmed_at && !session('2fa_passed')) {
            if (!in_array($request->route()->getName(), ['2fa.challenge', '2fa.challenge.post'])) {
                return redirect()->route('2fa.challenge');
            }
        }
        return $next($request);
    }
}

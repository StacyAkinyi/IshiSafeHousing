<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        // If the user has 2FA enabled, the default behavior of redirecting
        // to the two-factor-challenge page is correct. We let Fortify handle that.
        if (Auth::user()->two_factor_secret) {
             return redirect()->intended('/two-factor-challenge');
        }

        

    }
}
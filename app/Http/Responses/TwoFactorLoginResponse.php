<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;

class TwoFactorLoginResponse implements TwoFactorLoginResponseContract
{
    public function toResponse($request)
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'admin':
                return redirect()->intended('/admin/dashboard');
            case 'agent':
                return redirect()->intended('/agent/dashboard');
            default:
                return redirect()->intended('/dashboard');
        }
    }
}
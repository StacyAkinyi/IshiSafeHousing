<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // Get the authenticated user's role
        $role = Auth::user()->role;

        // Define the redirect path based on the user's role
        switch ($role) {
            case 'admin':
                $redirectPath = '/admin/dashboard';
                break;
            case 'agent':
                $redirectPath = '/agent/dashboard';
                break;
            default: // 'student' or any other role
                $redirectPath = '/dashboard';
                break;
        }

        // Redirect the user to their specific dashboard
        return redirect()->intended($redirectPath);
    }
}
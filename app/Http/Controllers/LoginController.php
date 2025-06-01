<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PragmaRX\Google2FALaravel\Facade as Google2FA;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth')->only([
            'show2faSetupForm',
            'post2faSetup'
        ]);
    }

        public function showLoginForm()
    {
       
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('name', 'password');

        // Attempt to authenticate the user
        $user = User::where('name', $credentials['name'])->first();

        if (!$user || !Auth::attempt($credentials)) {
             throw ValidationException::withMessages([
                'name' => ['Invalid credentials.'],
            ]);
        }
       //if user has 2fa enabled but not confirmed
        if ($user->two_factor_secret && !$user->two_factor_confirmed_at) {
            Auth::login($user);
            // Generate a one-time code
            $request->session()->put('2fa_passed', false); //store username in session
            return redirect('/2fa'); //redirect to 2fa page
        }
        // Authentication was successful
        $request->session()->regenerate();
        return redirect()->intended('/dashboard'); // Redirect to a dashboard or home page

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); // Redirect to the home page
    }

    public function showRegistrationForm()
    {
        return view('auth.register');  
    }

    public function register(Request $request)
    {
        //validate the data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed', 
            'password_confirmation' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        //create the user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'two_factor_secret' => Google2FA::generateSecretKey(),
        ]);
        Auth::login($user);

        //redirect to 2fa setup page.
        return redirect('/2fa-setup');
    }

   

   
}

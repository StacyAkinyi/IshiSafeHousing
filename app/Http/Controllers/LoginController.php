<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PragmaRX\Google2FA\Laravel\Facade as Google2FA;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
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
       //if user has 2fa enabled.
        if ($user->two_factor_secret) {
            // Generate a one-time code
            $request->session()->put('login_username', $user->name); //store username in session
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
        ]);

        //login the user
        Auth::login($user);
        //generate 2fa secret key.
        $user->two_factor_secret = Google2FA::generateSecretKey();
        $user->save();

        //redirect to 2fa setup page.
        return redirect('/2fa/setup');
    }

    public function show2faForm()
    {
        return view('auth.2fa');
    }

    public function post2fa(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'one_time_password' => 'required|string|min:6|max:6',
        ]);

         if ($validator->fails()) {
            return redirect('/2fa')
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::where('name', session('login_username'))->first();
        $OTP = $request->input('one_time_password');
        //validate the one time password
        if (Google2FA::verifyKey($user->two_factor_secret,$OTP))
        {
            $request->session()->put('2fa_confirmed', true);
            $user->two_factor_confirmed_at = now();
            $user->save();
            return redirect()->intended('/dashboard');
        }
        else{
             throw ValidationException::withMessages([
                'one_time_password' => ['Invalid one time password.'],
            ]);
        }

    }

     public function show2faSetupForm()
    {
        $user = Auth::user();
        $QR_code = Google2FA::getQRCodeUrl(
            config('app.name'),
            $user->email,
            $user->two_factor_secret
        );
        return view('auth.2fa-setup', ['QR_code' => $QR_code]);
    }

    public function post2faSetup(Request $request)
    {
         $user = Auth::user();
         $validator = Validator::make($request->all(),[
            'one_time_password' => 'required|string|min:6|max:6',
        ]);

         if ($validator->fails()) {
            return redirect('/2fa/setup')
                ->withErrors($validator)
                ->withInput();
        }

        if (Google2FA::verifyKey($user->two_factor_secret,$request->one_time_password))
        {
            $user->two_factor_confirmed_at = now();
            $user->save();
            return redirect('/dashboard');
        }
        else{
            throw ValidationException::withMessages([
                'one_time_password' => ['Invalid One Time Password'],
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FAQRCode\Google2FA;

class TwoFactorController extends Controller
{
    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    // Show the 2FA setup page with QR code
    public function showSetupForm(Request $request)
    {
        $user = Auth::user();

        // Generate a secret key if not already set
        if (empty($user->two_factor_secret)) {
            $user->two_factor_secret = $this->google2fa->generateSecretKey();
            $user->save();
        }

        $inlineUrl = $this->google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $user->two_factor_secret
        );

        // Pass the QR code svg inline to view
        return view('auth.2fa-setup', ['qrCodeSvg' => $inlineUrl]);
    }

    // Enable 2FA by verifying the code entered by the user
    public function enable2fa(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $user = Auth::user();

        $valid = $this->google2fa->verifyKey($user->two_factor_secret, $request->input('code'));

        if ($valid) {
            $user->two_factor_confirmed_at = true;
            $user->save();

            session(['2fa_passed' => true]); // Mark 2FA as passed for this session

            return redirect()->route('dashboard')->with('success', 'Two-factor authentication enabled!');
        }

        return back()->withErrors(['code' => 'Invalid authentication code, please try again.']);
    }

    // Show the 2FA challenge page (after login)
    public function showChallengeForm()
    {
        return view('auth.two-factor-challenge');
    }

    // Verify 2FA code or recovery code during login
    public function verifyChallenge(Request $request)
    {
        $request->validate([
            'code' => 'nullable|string',
            'recovery_code' => 'nullable|string',
        ]);

        $user = Auth::user();

        $code = $request->input('code');
        $recoveryCode = $request->input('recovery_code');

        // Here, you need to verify the code or recovery code.
        // For simplicity, let's just verify the Google Authenticator code.

        $validCode = false;

        if ($code) {
            $validCode = $this->google2fa->verifyKey($user->two_factor_secret, $code);
        }

        if ($recoveryCode) {
            // TODO: Verify recovery code here
            // For now, just reject recovery codes (implement your own logic)
            $validCode = false;
        }

        if ($validCode) {
            // Mark the 2FA as passed for the session
            session(['2fa_passed' => true]);

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['code' => 'Invalid authentication or recovery code.']);
    }
}




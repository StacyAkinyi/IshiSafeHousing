<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2FA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      body {
        font-family: 'Inter', sans-serif;
      }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-100 to-blue-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white/80 backdrop-blur-md rounded-xl shadow-lg p-8 w-full max-w-2xl">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Two-Factor Authentication</h1>
        
        @if (session('status') == "two-factor-authentication-disabled")
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                <p>Two-Factor Authentication has been disabled.</p>
            </div>
        @endif

        @if (session('status') == "two-factor-authentication-enabled")
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                <p>Two-Factor Authentication has been enabled. Please scan the QR code and save your recovery codes.</p>
            </div>
        @endif

        <div class="mt-6 text-center">
            <form method="POST" action="/user/two-factor-authentication" class="mb-6">
                @csrf

                @if (auth()->user()->two_factor_secret)
                    @method('DELETE')

                    <div class="my-6 p-6 bg-slate-100 rounded-lg">
                        <h3 class="text-lg font-semibold text-slate-800 mb-4">Your 2FA is Active</h3>
                        <p class="text-slate-600 mb-4">To disable, please click the button below.</p>
                        <!-- Destructive Action Button (Red) -->
                        <button type="submit" class="bg-red-600 text-white font-semibold py-2 px-5 rounded-lg hover:bg-red-700 transition duration-200 shadow-sm">
                            Disable 2FA
                        </button>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-8 text-left">
                        <!-- QR Code -->
                        <div class="p-4 border rounded-lg">
                            <h3 class="font-semibold text-lg mb-2">Scan QR Code</h3>
                            <p class="text-sm text-slate-600 mb-4">Scan this QR code with your authenticator app to sync your account.</p>
                            <div class="flex justify-center">
                                {!! auth()->user()->twoFactorQrCodeSvg() !!}
                            </div>
                        </div>
                        <!-- Recovery Codes -->
                        <div class="p-4 border rounded-lg">
                             <h3 class="font-semibold text-lg mb-2">Recovery Codes</h3>
                             <p class="text-sm text-slate-600 mb-4">Store these codes in a safe place. They can be used to recover access to your account if you lose your device.</p>
                             <ul class="space-y-2 bg-slate-50 p-3 rounded text-slate-700 font-mono text-sm">
                                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                                    <li>{{ $code }}</li>
                                @endforeach
                             </ul>
                        </div>
                    </div>

                @else
                    <!-- Primary Action Button (Purple) -->
                    <button type="submit" class="bg-purple-600 text-white font-bold py-3 px-6 rounded-full hover:bg-purple-700 transition duration-300 shadow-lg">
                        Enable Two-Factor Authentication
                    </button>
                @endif
            </form>

            <div class="mt-8 border-t pt-6">
                 <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    
                    <button type="submit" class="w-full sm:w-auto bg-slate-200 text-slate-800 font-semibold py-2 px-5 rounded-lg hover:bg-slate-300 transition duration-200 border border-slate-300">
                        Logout
                    </button>
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>

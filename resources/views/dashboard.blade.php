<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      body {
        font-family: 'Inter', sans-serif;
      }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-100 to-blue-100 min-h-screen flex items-center justify-center">
    <div class="bg-white/80 backdrop-blur-md rounded-xl shadow-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Welcome to Your Dashboard</h1>
        <p class="text-gray-700 mb-4">You are now logged in.</p>
        <p class="text-gray-700 mb-6">This is a placeholder for your dashboard content.  You could display user-specific information or links to other parts of the application here.</p>
        <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Two Factor Authentication') }}</div>

                <div class="card-body">
                    @if (session('status') == "two-factor-authentication-disabled")
                        <div class="alert alert-success" role="alert">
                            Two factor Authentication has been disabled.
                        </div>
                    @endif

                    @if (session('status') == "two-factor-authentication-enabled")
                        <div class="alert alert-success" role="alert">
                            Two factor Authentication has been enabled.
                        </div>
                    @endif


                    <form method="POST" action="/user/two-factor-authentication">
                      @csrf

                      @if (auth()->user()->two_factor_secret)
                      @method('DElETE')

                      <div class="pb-5">
                                {!! auth()->user()->twoFactorQrCodeSvg() !!}
                        </div>

                      <div>
                         <h3>Recovery Codes:</h3>

                          <ul>
                            @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                              <li>{{ $code }}</li>
                           @endforeach
                          </ul>
                      </div>

                            <button class="btn btn-danger">Disable</button>
                        @else
                            <button class="btn btn-primary" color="blue">Enable</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf 

          
          <button type="submit">Logout</button>
        </form>
        
    </div>
    </body>
</html>
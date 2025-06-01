protected $routeMiddleware = [
        //...
        '2fa.setup' => \App\Http\Middleware\EnsureTwoFactorIsVerified::class,
        '2fa.challenge' => \App\Http\Middleware\EnsureTwoFactorIsVerified::class,
    ];

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TwoFactorController;

// Login & Register
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);

// 2FA Challenge (no middleware - happens right after login)
Route::get('/two-factor-challenge', [TwoFactorController::class, 'showChallengeForm'])->name('2fa.challenge');
Route::post('/two-factor-challenge', [TwoFactorController::class, 'verifyChallenge'])->name('2fa.challenge.post');

// Routes that need login + 2FA setup & verification
Route::middleware(['auth', '2fa'])->group(function () {
    Route::get('/2fa-setup', [TwoFactorController::class, 'showSetupForm'])->name('2fa.setup');
    Route::post('/2fa-setup', [TwoFactorController::class, 'enable2fa'])->name('2fa.setup.post');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

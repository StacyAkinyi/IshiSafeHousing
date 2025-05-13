<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);

Route::get('/2fa', [LoginController::class, 'show2faForm'])->name('2fa');
Route::post('/2fa', [LoginController::class, 'post2fa']);

Route::get('/2fa/setup', [LoginController::class, 'show2faSetupForm'])->name('2fa.setup');
Route::post('/2fa/setup', [LoginController::class, 'post2faSetup']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth', 'verified', '2fa');


Route::get('/', function () {
    return view('welcome');
});

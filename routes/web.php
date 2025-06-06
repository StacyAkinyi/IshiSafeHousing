<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified']);
Route::view('/profile/edit', 'profile.edit')->middleware('auth');
Route::view('/profile/password', 'profile.password')->middleware('auth');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
      Route::get('/users', [AdminController::class, 'manageUsers'])->name('users');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');

    // You can add other admin-only routes here later, for example:
    // Route::get('/users', [AdminController::class, 'manageUsers'])->name('users');
    // Route::get('/properties', [AdminController::class, 'manageProperties'])->name('properties');

});
Route::middleware(['auth'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', function() {
        // Later, you will create an AgentController for this
        return '<h1>Agent Dashboard</h1>';
    })->name('dashboard');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        // This is the default dashboard for students
        return view('dashboard'); // Assumes you have a dashboard.blade.php
    })->name('dashboard');
});
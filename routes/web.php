<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// --- GUEST ROUTES ---
// Accessible to everyone.
Route::get('/', function () {
    return view('welcome');
});


// --- AUTHENTICATED ROUTES ---

// Admin-specific routes.
// The 'auth' middleware ensures the user is logged in.
// The 'admin' middleware (which you should create) ensures the user's role is 'admin'.
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('users');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    
    });

// Agent-specific routes.
// This group requires the user to be logged in. You could add a custom 'agent'
// middleware here later if needed, just like the 'admin' one.
Route::middleware(['auth'])->prefix('agent')->name('agent.')->group(function () {
   Route::get('/dashboard', [AgentController::class, 'dashboard'])->name('dashboard');
});

// Student-specific dashboard (this is the default dashboard).
// The route name 'dashboard' doesn't conflict with the others because the redirection
// logic will use the full route name (e.g., 'admin.dashboard', 'agent.dashboard')
// or the specific URL path.
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');
});


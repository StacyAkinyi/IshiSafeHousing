<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Student\AccountController;



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
    Route::put('/users', [AdminController::class, 'update'])->name('users.update');
    Route::delete('/users', [AdminController::class, 'destroy'])->name('users.destroy');
    Route::get('/properties', [AdminController::class, 'manageProperties'])->name('properties');
    Route::post('/properties', [AdminController::class, 'storeProperty'])->name('properties.store');
    
    });


Route::middleware(['auth'])->prefix('agent')->name('agent.')->group(function () {
   Route::get('/dashboard', [AgentController::class, 'dashboard'])->name('dashboard');
   Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
   Route::get('/properties/{property}/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
   Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
});

Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::post('/account/update-details', [AccountController::class, 'updateDetails'])->name('account.updateDetails');
    Route::post('/account/update-next-of-kin', [AccountController::class, 'updateNextOfKin'])->name('account.updateNextOfKin');
});




Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');
});


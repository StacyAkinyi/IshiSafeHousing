<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Student\AccountController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\HomeController;



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

Route::get('/', [HomeController::class, 'index'])->name('welcome');

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
    Route::get('/properties/{property}/edit', [AdminController::class, 'editProperty'])->name('properties.edit');
    Route::put('/properties/{property}', [AdminController::class, 'updateProperty'])->name('properties.update');
    Route::delete('/properties/{property}', [AdminController::class, 'deleteProperty'])->name('properties.destroy');
    Route::delete('/bookings/{booking}', [AdminController::class, 'destroyBooking'])->name('bookings.destroy');
    Route::delete('/reviews/{review}', [AdminController::class, 'destroyReview'])->name('reviews.destroy');
    Route::get('/properties/{property}/rooms', [AdminController::class, 'getPropertyRooms'])->name('properties.getRooms');
    });


Route::middleware(['auth'])->prefix('agent')->name('agent.')->group(function () {
   Route::get('/dashboard', [AgentController::class, 'dashboard'])->name('dashboard');
   Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
   Route::get('/properties/{property}/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
   Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
   Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
   Route::patch('/account', [AgentController::class, 'updateAccount'])->name('account.update');
   Route::patch('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
});

Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/account', [StudentController::class, 'index'])->name('account.index');
    Route::put('/account', [StudentController::class, 'update'])->name('account.update');
     Route::post('/account/update-details', [StudentController::class, 'updateDetails'])
         ->name('account.updateDetails');
    // This route handles the next of kin form submission
    Route::post('/account/update-next-of-kin', [StudentController::class, 'updateNextOfKin'])
         ->name('account.updateNextOfKin');
    Route::get('/properties/{property}/rooms', [PropertyController::class, 'getRooms'])->name('properties.rooms');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});




Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/properties/search', [PropertyController::class, 'search'])->name('properties.search');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');


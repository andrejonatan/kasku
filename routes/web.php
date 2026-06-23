<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth routes for Anggota
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile/photo', [AuthController::class, 'updateProfilePhoto'])->name('profile.photo.update');

    // Kas payment
    Route::get('/payment/kas', [PaymentController::class, 'showKasForm'])->name('payment.kas');
    Route::post('/payment/kas', [PaymentController::class, 'payKas'])->name('payment.kas.post');

    // Study Tour payment
    Route::get('/payment/tour', [PaymentController::class, 'showTourForm'])->name('payment.tour');
    Route::post('/payment/tour', [PaymentController::class, 'payTour'])->name('payment.tour.post');

    // Payment success
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
});

// Monitoring Kas (public - no auth required)
Route::get('/monitoring/kas', [PaymentController::class, 'monitoring'])->name('monitoring.kas');
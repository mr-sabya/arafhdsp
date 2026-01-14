<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');

// service
Route::get('/service', [App\Http\Controllers\Frontend\ServiceController::class, 'index'])->name('service');

// diagnostic
Route::get('/diagnostic', [App\Http\Controllers\Frontend\DiagnosticController::class, 'index'])->name('diagnostic');

// hospitals
Route::get('/hospitals', [App\Http\Controllers\Frontend\HospitalController::class, 'index'])->name('hospitals');

// about
Route::get('/about', [App\Http\Controllers\Frontend\AboutController::class, 'index'])->name('about');

// contact
Route::get('/contact', [App\Http\Controllers\Frontend\ContactController::class, 'index'])->name('contact');


// --- Routes for GUESTS only (Logged-out users) ---
Route::middleware('guest')->group(function () {

    // Login Routes
    Route::get('/login', [App\Http\Controllers\Frontend\AuthController::class, 'login'])->name('login');

    // Registration Routes
    Route::get('/register', [App\Http\Controllers\Frontend\AuthController::class, 'register'])->name('register');

    Route::get('/verify-otp/{mobile}', [App\Http\Controllers\Frontend\AuthController::class, 'verify'])->name('verify.otp');
});

Route::middleware('auth')->group(function () {
    Route::get('/payment', [App\Http\Controllers\Frontend\PaymentController::class, 'payment'])->name('payment');

    // payment status
    Route::get('/payment-status', [App\Http\Controllers\Frontend\PaymentController::class, 'paymentStatus'])->name('payment.status');

    // user dashboard
    Route::get('/user/dashboard', [App\Http\Controllers\Frontend\UserController::class, 'dashboard'])->name('user.dashboard');
});

// Field Worker Routes: domain.com/worker/...
Route::middleware('auth')->prefix('worker')->name('worker.')->group(function () {
    // dashboard
    Route::get('/dashboard', [App\Http\Controllers\Worker\HomeController::class, 'index'])->name('dashboard');

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [App\Http\Controllers\Worker\UserController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Worker\UserController::class, 'create'])->name('create');
        Route::get('/verify-otp/{user_id}', [App\Http\Controllers\Worker\UserController::class, 'verifyOtp'])->name('verify');
        Route::get('/process-payment/{user_id}', [App\Http\Controllers\Worker\UserController::class, 'processPayment'])->name('payment');
    });
});

// Hospital/Diagnostic Routes: domain.com/partner/...
Route::prefix('partner')->name('partner.')->group(...);

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

// login
Route::get('/login', function () {
    return view('frontend.home.index');
})->name('login');

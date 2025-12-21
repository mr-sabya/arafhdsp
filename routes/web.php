<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home.index');
});

// login
Route::get('/login', function () {
    return view('frontend.home.index');
})->name('login');

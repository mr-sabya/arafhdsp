<?php

use Illuminate\Support\Facades\Route;

// auth routes
Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('login');

Route::middleware('auth:admin')->group(function () {
    // dashboard route
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Hero Banner Management

    Route::name('website.')->group(function () {
        Route::get('/hero-banner', [App\Http\Controllers\Admin\HeroBannerController::class, 'index'])->name('hero-banner.index');

        // service-section page
        Route::get('/service-section', [App\Http\Controllers\Admin\ServiceController::class, 'serviceSection'])->name('service-section.index');

        // Services Management
        Route::get('/services', [App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('service.index');

        // Skill Management
        Route::get('/skills', [App\Http\Controllers\Admin\SkillController::class, 'index'])->name('skill.index');
    });

    // Location Management
    Route::prefix('locations')->name('locations.')->group(function () {
        Route::get('/divisions', [App\Http\Controllers\Admin\LocationController::class, 'division'])->name('divisions');

        // district route
        Route::get('/districts', [App\Http\Controllers\Admin\LocationController::class, 'district'])->name('districts');

        // upazila route
        Route::get('/upazilas', [App\Http\Controllers\Admin\LocationController::class, 'upazila'])->name('upazilas');

        // area route
        Route::get('/areas', [App\Http\Controllers\Admin\LocationController::class, 'area'])->name('areas');
    });

    // blood group
    Route::get('/blood-group', [App\Http\Controllers\Admin\BloodGroupController::class, 'index'])->name('blood.group');

    // pricing plan
    Route::get('/pricing-plan', [App\Http\Controllers\Admin\PricingPlanController::class, 'index'])->name('pricing.index');
    Route::get('/payment-methods', [App\Http\Controllers\Admin\PaymentMethodController::class, 'index'])->name('payment-method.index');


    // Hospital Management
    Route::prefix('hospital')->name('hospital.')->group(function () {
        Route::get('/departmemts', [App\Http\Controllers\Admin\HospitalController::class, 'departments'])->name('departments');

        // doctors
        Route::get('/doctors', [App\Http\Controllers\Admin\HospitalController::class, 'doctors'])->name('doctors');

        Route::get('/hospitals', [App\Http\Controllers\Admin\HospitalController::class, 'hospitals'])->name('hospitals');
    });

    // Diagnostic Management
    Route::prefix('diagnostic')->name('diagnostic.')->group(function () {
        Route::get('/diagnostic-center', [App\Http\Controllers\Admin\DiagnosticController::class, 'index'])->name('index');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('create');
        Route::get('/{id}/edit/', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
        Route::get('/roles', [App\Http\Controllers\Admin\UserController::class, 'role'])->name('role.index');
    });

    // Member Management
    Route::prefix('member')->name('member.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\MemberController::class, 'index'])->name('index');
    });
});

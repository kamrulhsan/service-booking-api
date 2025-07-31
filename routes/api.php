<?php

use App\Http\Controllers\Api\v1\{
    AuthController,
    BookingsController,
    ServiceController
};
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('auth.register');
    Route::post('/login', 'login')->name('auth.login');
    Route::post('/admin-login', 'adminLogin')->name('auth.adminLogin');
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Services for all users
    Route::controller(ServiceController::class)->group(function () {
        Route::get('/services', 'index');
    });

    // Bookings for user
    Route::controller(BookingsController::class)->group(function () {
        Route::post('/bookings', 'store');
        Route::get('/bookings/user', 'fetchByUser');
    });

    Route::middleware([IsAdmin::class])->group(function () {

        // Admin Services
        Route::controller(ServiceController::class)->group(function () {
            Route::get('/services/{service}', 'show');
            Route::post('/services', 'store');
            Route::put('/services/{service}', 'update');
            Route::delete('/services/{service}', 'destroy');
        });

        // Admin Bookings
        Route::controller(BookingsController::class)->group(function () {
            Route::get('/bookings', 'index');
            Route::put('/bookings/{booking}/status', 'updateStatus');
            Route::delete('/bookings/{booking}', 'destroy');
        });
    });
});

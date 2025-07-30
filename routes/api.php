<?php

use App\Http\Controllers\Api\v1\{
    AuthController,
    ServiceController
};
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::post('/registration', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/admin-login', [AuthController::class, 'adminLogin'])->name('auth.login');


Route::middleware(['auth:sanctum', IsAdmin::class])->group(function () {
    // Manage Services
    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/services/{service}', [ServiceController::class, 'show']);
    Route::post('/services', [ServiceController::class, 'store']);
    Route::put('/services/{service}', [ServiceController::class, 'update']);
    Route::delete('/services/{service}', [ServiceController::class, 'destroy']);
});

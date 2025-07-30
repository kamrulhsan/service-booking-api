<?php

use App\Http\Controllers\Api\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/registration', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/admin-login', [AuthController::class, 'adminLogin'])->name('auth.login');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

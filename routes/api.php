<?php

use App\Http\Controllers\Api\ListUsersController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', ListUsersController::class);
    Route::post('logout', [AuthController::class, 'logout']);
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\TicketApiController;
use App\Http\Controllers\Api\CategoryApiController;

Route::post('login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthApiController::class, 'me']);
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::apiResource('tickets', TicketApiController::class);

    Route::middleware('admin')->group(function () {
        Route::apiResource('categories', CategoryApiController::class);
        Route::apiResource('users', UserApiController::class);
    });
});
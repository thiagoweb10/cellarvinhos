<?php

use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\TicketApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryApiController::class);
Route::apiResource('tickets', TicketApiController::class);
<?php

use App\Http\Controllers\Api\CategoryApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryApiController::class);

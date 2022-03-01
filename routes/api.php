<?php

use App\Http\Controllers\API\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

Route::middleware('auth:sanctum')->group(
    function () {
        Route::get('/user', [UserController::class, 'info']);

        Route::get('/clients', [ClientController::class, 'index']);
    }
);

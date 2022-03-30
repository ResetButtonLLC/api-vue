<?php

use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

Route::middleware('auth:sanctum')->group(
    function () {
        Route::get('/user', [UserController::class, 'info']);

        /** CLIENTS */
        Route::get('/clients', [ClientController::class, 'index']);
        Route::post('/client/create', [ClientController::class, 'create']);

        /** PROFILES */
        Route::get('/profiles', [ProfileController::class, 'index']);
        Route::post('/profile/create', [ProfileController::class, 'create']);
    }
);

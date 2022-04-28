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

/** USERS */
//Route::middleware('can:admin1')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/user/{user}', [UserController::class, 'view'])->name('user.view');
    Route::patch('/user/{user}', [UserController::class, 'update'])->name('user.update');
//});


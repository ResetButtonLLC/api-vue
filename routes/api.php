<?php

use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

Route::middleware('auth:sanctum')->group(
    function () {

        /* USERS */
        Route::get('/user', [UserController::class, 'info']);

        Route::middleware('can:admin')->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::get('/user/{user}', [UserController::class, 'view'])->name('user.view');
            Route::patch('/user/{user}', [UserController::class, 'update'])->name('user.update');
        });

        /** CLIENTS */
        Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
        Route::post('/client', [ClientController::class, 'create'])->name('client.create');
        Route::get('/client/{client}', [ClientController::class, 'view'])->name('client.view');
        Route::patch('/client/{client}', [ClientController::class, 'update'])->name('client.update');
        Route::delete('/client/{client}', [ClientController::class, 'delete'])->name('client.delete');

        /** PROFILES */
        Route::get('/profiles', [ProfileController::class, 'index']);
        Route::post('/profile/create', [ProfileController::class, 'create']);
    }
);





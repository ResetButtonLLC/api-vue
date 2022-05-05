<?php

use App\Http\Controllers\API\ProjectController;
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

        /** projectS */
        Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::post('/project', [ProjectController::class, 'create'])->name('project.create');
        Route::get('/project/{project}', [ProjectController::class, 'view'])->name('project.view');
        Route::patch('/project/{project}', [ProjectController::class, 'update'])->name('project.update');
        Route::delete('/project/{project}', [ProjectController::class, 'delete'])->name('project.delete');

        /** PROFILES */
        Route::get('/profiles', [ProfileController::class, 'index']);
        Route::post('/profile/create', [ProfileController::class, 'create']);
    }
);





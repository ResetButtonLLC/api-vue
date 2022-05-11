<?php

use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;

Route::middleware('auth:sanctum')->group(
    function () {

        /* USERS */
        Route::get('/user', [UserController::class, 'info'])->name('user.info'); //Для совместимости c роутом
        Route::get('/me', [UserController::class, 'me'])->name('user.me');
        Route::middleware('can:user.managment')->group(function () {
            Route::get('/users/all', [UserController::class, 'all'])->name('users.all');
            Route::get('/user/{user}', [UserController::class, 'view'])->name('user.view');
            Route::patch('/user/{user}', [UserController::class, 'update'])->name('user.update');
        });

        /** PROJECTS */
        Route::get('/projects/all', [ProjectController::class, 'all'])->name('projects.all');
        Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::post('/project', [ProjectController::class, 'create'])->name('project.create');
        Route::middleware('can:project.access,project')->group(function () {
            Route::get('/project/{project}', [ProjectController::class, 'view'])->name('project.view');
            Route::patch('/project/{project}', [ProjectController::class, 'update'])->name('project.update');
            Route::delete('/project/{project}', [ProjectController::class, 'delete'])->name('project.delete');
        });

        /** PROFILES */
        Route::post('/profile', [ProfileController::class, 'create'])->name('profile.create');
        Route::get('/profile/{profile}', [ProfileController::class, 'view'])->name('profile.view');
        Route::patch('/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile/{profile}', [ProfileController::class, 'delete'])->name('profile.delete');

    }
);





<?php

use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;


$notFound = function (Request $request) {
    return response('',404, ['content-type' => 'application/json']);
};

Route::middleware('auth:sanctum')->group(
    function () use ($notFound){

        /* USERS */
        Route::get('/user', [UserController::class, 'info']);
        Route::middleware('can:admin')->group(function () use ($notFound) {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::get('/user/{user}', [UserController::class, 'view'])->name('user.view')->missing($notFound);
            Route::patch('/user/{user}', [UserController::class, 'update'])->name('user.update')->missing($notFound);
        });

        /** projectS */
        Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::post('/project', [ProjectController::class, 'create'])->name('project.create');
        Route::get('/project/{project}', [ProjectController::class, 'view'])->name('project.view')->missing($notFound);
        Route::patch('/project/{project}', [ProjectController::class, 'update'])->name('project.update')->missing($notFound);
        Route::delete('/project/{project}', [ProjectController::class, 'delete'])->name('project.delete')->missing($notFound);

        /** PROFILES */
        Route::get('/profiles', [ProfileController::class, 'index']);
        Route::post('/profile/create', [ProfileController::class, 'create']);
    }
);





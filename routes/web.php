<?php

use Illuminate\Support\Facades\Route;
use Promodo\LaravelAzureAuth\Azure;

Route::get('/login', [Azure::class, 'azure'])->name('login');
Route::get('/login/azurecallback', [Azure::class, 'azurecallback']);
Route::get('/logout', function () {
    if (auth()->check()) {
        auth()->logout();
    }
    return redirect('/guest');
})->name('logout');

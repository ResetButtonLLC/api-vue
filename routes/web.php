<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Promodo\LaravelAzureAuth\Azure;

Route::get('/test0', [TestController::class, 'test']);

Route::get('/login', [Azure::class, 'azure'])->name('login');
Route::get('/login/azurecallback', [Azure::class, 'azurecallback']);
Route::get('/logout', function () {
    if (auth()->check()) {
        auth()->logout();
    }
    return redirect('/guest');
})->name('logout');
Route::fallback(function () {
    abort(404);
});;

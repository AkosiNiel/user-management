<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes (Authenticated Users)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Dashboard for all users
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // Regular user profile routes
    Route::get('/profile/edit', [UserController::class, 'editOwn'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateOwn'])->name('profile.update');

    /*
    |--------------------------------------------------------------------------
    | Superadmin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['check.superadmin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});

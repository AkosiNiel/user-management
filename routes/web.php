<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Login and Logout routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // Resource routes include index, create, store, show, edit, update, destroy
    Route::resource('users', UserController::class);

    // Optional: If you only want superadmins to delete users
    Route::middleware(['check.superadmin'])->group(function () {
      
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});
=======

Route::get('/', function () {
    return view('welcome');
});
>>>>>>> 973fba8 (changes)

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::group(['middleware' => 'web'], function () {

    // Users Authentication routes

    Route::middleware(['guest'])->group(function() {
        // Registration...
        Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

        Route::post('/register', [RegisteredUserController::class, 'store'])->name('signup');

        // Authentication...
        Route::get('/login', [LoginController::class, 'create'])->name('login');

        Route::post('/login', [LoginController::class, 'store'])->middleware(['throttle:6,1'])->name('authenticate');

        // Password Reset...
        Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

        Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');

        Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
    });

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');


	// Admin Authentication routes

    Route::prefix('admin')->name('admin.')->group(function() {
        Route::middleware(['guest:admin'])->group(function() {
            // Authentication...
            Route::get('/login', [LoginController::class, 'create'])->name('login');

            Route::post('/login', [LoginController::class, 'store'])->middleware(['throttle:6,1'])->name('authenticate');
        });

        Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    });



	
});





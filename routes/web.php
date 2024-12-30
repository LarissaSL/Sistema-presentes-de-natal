<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::POST('/login', 'login')->name('auth.login');
    Route::POST('/logout', 'logout')->name('auth.logout');
    
});

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index')->name('main.index');

    Route::get('/register', 'register')->name('main.register');
    Route::get('/registerSubmit', 'registerSubmit')->name('main.registerSubmit');
});

Route::controller(UserController::class)->group(function() {
    Route::get('/dashboard', 'index')->name('user.dashboard');
});
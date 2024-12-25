<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('auth.index');
    Route::POST('/login', 'login')->name('auth.login');
    
    Route::get('/register', 'register')->name('auth.register');
    Route::get('/registerSubmit', 'registerSubmit')->name('auth.registerSubmit');
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckUserLogged;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('auth.login');
    Route::POST('/login', 'loginSubmit')->name('auth.loginSubmit');
    Route::get('/logout', 'logout')->name('auth.logout');
});

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index')->name('main.index');
});

Route::controller(UserController::class)->group(function() {
    Route::get('/register', 'register')->name('user.register');
    Route::POST('/register', 'registerSubmit')->name('user.registerSubmit');

    Route::prefix('/user')->group(function (){
        Route::middleware([CheckUserLogged::class])->group(function() {
            Route::get('/dashboard', 'index')->name('user.dashboard');
            Route::get('/my-profile/{id}', 'read')->name('user.myProfile');
            Route::POST('/my-profile/update/{id}', 'update')->name('user.update');
        });
    });
});
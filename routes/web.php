<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckContact;
use App\Http\Middleware\CheckUser;
use App\Http\Middleware\CheckUserLogged;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('auth.login');
    Route::post('/login', 'loginSubmit')->name('auth.loginSubmit');
    Route::get('/logout', 'logout')->name('auth.logout')->middleware(CheckUserLogged::class);
});

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index')->name('main.index');
});

Route::controller(UserController::class)->group(function() {
    Route::get('/register', 'register')->name('user.register');
    Route::post('/register', 'registerSubmit')->name('user.registerSubmit');

    Route::prefix('/user')->middleware([CheckUserLogged::class, CheckUser::class])->group(function () {
        Route::get('/dashboard', 'index')->name('user.dashboard');
        Route::get('/my-profile', 'read')->name('user.myProfile');
        Route::post('/my-profile/update', 'update')->name('user.update');
        Route::get('/my-profile/delete', 'delete')->name('user.delete');
    });
});

Route::controller(ContactController::class)->group(function() {
    Route::prefix('/user/contact')->middleware([CheckUserLogged::class, CheckUser::class])->group(function () {
        Route::get('/', 'index')->name('contact.listContacts');
        Route::get('/create', 'create')->name('contact.create');
        Route::post('/createSubmit', 'createSubmit')->name('contact.createSubmit');
        Route::get('/update/{id}', 'update')->name('contact.update')->middleware(CheckContact::class);
        Route::post('/updateSubmit', 'updateSubmit')->name('contact.updateSubmit');
        Route::get('/delete/{id}', 'delete')->name('contact.delete');
    });
});

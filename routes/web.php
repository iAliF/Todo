<?php

use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserRegisterController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'layout')->name('home');

Route::prefix('/register')->name('register.')->controller(UserRegisterController::class)->group(function () {
    Route::get('/', 'create')->name('create');
    Route::post('/', 'store')->name('store');
});

Route::controller(UserLoginController::class)->group(function () {
    Route::post('/logout', 'destroy')->name('logout');
    Route::view('/login', 'layout')->name('login.create');
});

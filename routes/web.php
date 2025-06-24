<?php

use App\Http\Controllers\Auth\OTPLoginController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Dashboard\TodoController;
use Illuminate\Support\Facades\Route;

Route::post('/logout', [UserLoginController::class, 'destroy'])->name('logout');

Route::prefix('/register')
    ->name('register.')
    ->middleware('guest')
    ->controller(UserRegisterController::class)
    ->group(function () {
        Route::get('/', 'create')->name('create');
        Route::post('/', 'store')->name('store');
    });

Route::prefix('login')
    ->name('login.')
    ->controller(UserLoginController::class)
    ->middleware('guest')
    ->group(function () {
        Route::get('/', 'create')->name('create');
        Route::post('/', 'store')->name('store');
    });

Route::prefix('login/vc')
    ->name('vc.')
    ->controller(OTPLoginController::class)
    ->middleware('guest')
    ->group(function () {
        Route::get('/', 'create')->name('create');
        Route::post('/', 'generate')->name('generate');

        Route::get('/verify', 'verifyForm')->name('verify');
        Route::post('/verify', 'store')->name('store');
    });

Route::prefix('/')
    ->name('dashboard.')
    ->controller(TodoController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        route::post('/', 'store')->name('store');
        Route::patch('/{todo}', 'update')->name('update')->can('edit,todo');
        Route::delete('/{todo}', 'destroy')->name('destroy')->can('edit,todo');
    });


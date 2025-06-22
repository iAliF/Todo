<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserRegisterController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'layout')->name('home');

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

Route::prefix('/dashboard')
    ->name('dashboard.')
    ->controller(TodoController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        route::post('/', 'store')->name('store');
        Route::delete('/{todo}', 'destroy')->name('destroy')->can('delete,todo');
    });

Route::post('/logout', [UserLoginController::class, 'destroy'])->name('logout');


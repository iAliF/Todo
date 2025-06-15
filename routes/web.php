<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'layout');
Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');


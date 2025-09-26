<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios', function () {
    return view('usuarios');
});

Route::get('/login', function () {
    return view('login');
});
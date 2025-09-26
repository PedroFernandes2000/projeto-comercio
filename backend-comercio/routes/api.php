<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\UserController;


Route::apiResource('/produtos', ProdutosController::class);

Route::apiResource('/users', UserController::class);

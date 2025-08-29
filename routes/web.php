<?php

declare(strict_types=1);

use App\Http\Controllers\ProductsEagerController;
use App\Http\Controllers\ProductsLazyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products-lazy', ProductsLazyController::class);
Route::get('/products-eager', ProductsEagerController::class);

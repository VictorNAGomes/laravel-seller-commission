<?php

use App\Http\Controllers\SalesController;
use App\Http\Controllers\SellerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/greeting', function () {
    return 'Hello World';
});

Route::post('/seller', [SellerController::class, 'create']);
Route::get('/seller', [SellerController::class, 'getAll']);
Route::get('/seller/{id}', [SellerController::class, 'getById']);
Route::patch('/seller/{id}', [SellerController::class, 'update']);
Route::delete('/seller/{id}', [SellerController::class, 'delete']);

Route::post('/sales', [SalesController::class, 'create']);

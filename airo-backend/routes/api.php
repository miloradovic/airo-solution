<?php

use Illuminate\Support\Facades\Route;


/**
 * route "/login"
 * @method "POST"
 */
Route::post('/login', App\Http\Controllers\Api\LoginController::class);


/**
 * route "/user"
 * @method "GET"
 */
Route::middleware('auth:api')->post(
    '/quotation', App\Http\Controllers\Api\QuotationController::class
);

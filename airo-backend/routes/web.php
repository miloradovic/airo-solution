<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json('Airo software');
});

// require __DIR__.'/auth.php';

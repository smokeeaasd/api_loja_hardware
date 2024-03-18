<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resources([
    'products' => \App\Http\Controllers\ProductController::class
]);

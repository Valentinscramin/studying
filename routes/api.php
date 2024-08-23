<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products/categories/{category}', [CategoriesController::class, 'getProductsByCat']);
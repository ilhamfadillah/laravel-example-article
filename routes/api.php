<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{model}', [ProductController::class, 'show']);
Route::put('/products/{model}', [ProductController::class, 'update']);
Route::delete('/products/{model}', [ProductController::class, 'delete']);
Route::put('/products/{uuid}/restore', [ProductController::class, 'restore']);

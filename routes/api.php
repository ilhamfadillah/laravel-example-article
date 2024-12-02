<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
  Route::post('register', 'register');
  Route::get('me', 'me');
  Route::post('login', 'login');
  Route::post('logout', 'logout');
  Route::post('refresh', 'refresh');
});

Route::controller(ProductController::class)->group(function () {
  Route::get('products', 'index');
  Route::post('products', 'store');
  Route::get('products/{model}', 'show');
  Route::put('products/{model}', 'update');
  Route::delete('products/{model}', 'delete');
  Route::put('products/{uuid}/restore', 'restore');
});

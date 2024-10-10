<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductApiController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class);
Route::post('/products/sort-by-price', [ProductController::class, 'sortByPrice'])->name('products.sort');
Route::post('/products/calculate-total-stock', [ProductController::class, 'calculateTotalStock'])->name('products.calculateStock');
Route::get('/api-products', [ProductApiController::class, 'index'])->name('api.products.index');
<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
    Route::post('/update-product', [App\Http\Controllers\ProductsController::class, 'update'])->name('products.update');
    Route::get('/delete-product/{id}', [App\Http\Controllers\ProductsController::class, 'destroy'])->name('products.destroy');
   // Route::get('/products/{product}', [ProductsController::class, 'show'])->name('products.show');
    //Route::get('/products/{product}/edit', [ProductsController::class, 'edit'])->name('products.edit');
  //  Route::put('/products/{product}', [ProductsController::class, 'update'])->name('products.update');
  //  Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');
});
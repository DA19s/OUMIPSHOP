<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\VartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\HistoriqueClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboardClient', function () {
    return view('dashboardClient');
})->middleware(['auth', 'verified'])->name('dashboardClient');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::post('/cart/validate', [CartController::class, 'validateCart'])->name('cart.validate');
});

Route::middleware('auth')->group(function () {
    Route::get('/vart', [VartController::class, 'index'])->name('vart.index');
    Route::delete('/vart/{id}/cancel', [VartController::class, 'cancel'])->name('vart.cancel');
});

Route::middleware('auth')->group(function () {
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::patch('/order/{vart}/update-status', [OrderController::class, 'updateStatus'])->name('order.update-status');
    Route::post('/order/{vart}/historique', [OrderController::class, 'validateOrder'])->name('order.historique');
});

Route::middleware('auth')->group(function () {
    Route::get('/historique', [HistoriqueController::class, 'index'])->name('historique.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/historiqueClient', [HistoriqueClientController::class, 'index'])->name('historiqueClient.index');
});


require __DIR__.'/products.php';

require __DIR__.'/auth.php';


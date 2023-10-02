<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Auth::routes();

Route::get('/salon', [SalonController::class, 'homepage'])->name('salon.homepage');

Route::middleware(['ensureRoleIsAdminOrStaff'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('items')->group(function () {
        Route::get('/', [ItemController::class, 'index'])->name('items.index');
        Route::get('/create', [ItemController::class, 'create'])->name('items.create');
        Route::post('/', [ItemController::class, 'store'])->name('items.store');
        Route::get('/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::put('/{id}', [ItemController::class, 'update'])->name('items.update');
        Route::delete('/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
    });

    Route::resource('users', UserController::class)->except(['edit', 'update', 'show']);

    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/create', [NotificationController::class, 'create'])->name('notifications.create');
        Route::post('/', [NotificationController::class, 'store'])->name('notifications.store');
        Route::get('/{notification}/edit', [NotificationController::class, 'edit'])->name('notifications.edit');
        Route::put('/{notification}', [NotificationController::class, 'update'])->name('notifications.update');
        Route::delete('/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    });

});

Route::resource('customers', CustomerController::class)->except(['edit', 'update', 'show']);

// ショップ関連
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('shop/{item}', [ShopController::class, 'show'])->name('shop.show');

// カート関連
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{item}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/increase/{item}', [CartController::class, 'increaseQuantity'])->name('cart.increaseQuantity');
    Route::post('/decrease/{item}', [CartController::class, 'decreaseQuantity'])->name('cart.decreaseQuantity');
});

// 決済関連
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

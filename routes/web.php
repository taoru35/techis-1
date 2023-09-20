<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// ユーザー、管理者、スタッフ全てがアクセス可能なページ
Route::get('/salon', [SalonController::class, 'homepage'])->name('salon.homepage');

// 管理者とスタッフのみがアクセス可能なページ
Route::middleware(['ensureRoleIsAdminOrStaff'])->group(function () {



    // ダッシュボードページ
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // 商品管理ページ
    Route::prefix('items')->group(function () {
        Route::get('/', [ItemController::class, 'index'])->name('items.index');
        Route::get('/add', [ItemController::class, 'add'])->name('items.addForm');
        Route::post('/add', [ItemController::class, 'add'])->name('items.add');

        Route::get('/edit/{id}', [ItemController::class, 'edit'])->name('items.edit');
        Route::put('/edit/{id}', [ItemController::class, 'update'])->name('items.update');

        Route::delete('/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
        // ->middleware(['auth']); // ミドルウェアを適用する場合はこれを使用
    });


    // ユーザー関連ページ
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');
});



// カスタマー関連ページ
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');

Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');



// ショップ関連
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');


// カート
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{item}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');

Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/increase/{item}', [CartController::class, 'increaseQuantity'])->name('cart.increaseQuantity');
Route::post('/cart/decrease/{item}', [CartController::class, 'decreaseQuantity'])->name('cart.decreaseQuantity');

// 決済画面
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

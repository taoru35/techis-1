<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ImageController;

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

    // 商品関連ページ
    Route::prefix('items')->group(function () {
        Route::get('/', [ItemController::class, 'index']);
        Route::get('/add', [ItemController::class, 'add']);
        Route::post('/add', [ItemController::class, 'add']);
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





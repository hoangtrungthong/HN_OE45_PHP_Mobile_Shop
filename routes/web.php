<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;

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

require __DIR__.'/auth.php';

Route::group(['middleware' => 'locale'], function () {
    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::get('search', [ProductController::class, 'search'])->name('search');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('{product}', [HomeController::class, 'showProduct'])->name('showProduct');
});

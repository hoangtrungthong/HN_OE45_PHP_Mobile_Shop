<?php

use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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

Route::group(['middleware' => ['role:user','locale'] ], function () {
    Route::get('language/{language}', [HomeController::class, 'changeLang'])->name('lang');

    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');

    Route::get('{user}/edit-profile', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('{user}/update', [ProfileController::class, 'update'])->name('update');

    Route::get('{user}/edit-password', [ProfileController::class, 'editPassword'])->name('editPassword');
    Route::patch('{user}/change-password', [ProfileController::class, 'changePassword'])->name('changePassword');

    Route::get('profile-picture', [ProfileController::class, 'changePicture'])->name('picture');
    Route::post('update-profile-picture', [ProfileController::class, 'upload'])->name('upload');

    Route::post('add-to-cart/{slug}', [CartController::class, 'add'])->name('addCart');
    Route::post('update-cart/{slug}', [CartController::class, 'update'])->name('updateCart');
    Route::delete('remove-cart', [CartController::class, 'remove'])->name('removeCart');
    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');

    Route::post('order', [OrderController::class, 'store'])->name('order');
    Route::get('history-order', [OrderController::class, 'getOrderUser'])->name('historyOrder');
    Route::delete('destroy-order/{order}', [OrderController::class, 'destroy'])->name('destroyOrder');
});

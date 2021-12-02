<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'role:admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('manage-user', [ManageUserController::class, 'index'])->name('manageUser');
    Route::patch('{user}/block-user', [ManageUserController::class, 'blockUser'])->name('blockUser');
    Route::patch('{user}/active-user', [ManageUserController::class, 'activeUser'])->name('activeUser');

    Route::resource('categories', CategoryController::class);
    
    Route::resource('products', ProductController::class);
});

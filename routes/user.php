<?php

use App\Http\Controllers\User\ProfileController;
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

Route::group(['middleware' => 'role:user'], function () {
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');

    Route::get('{user}/edit-profile', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('{user}/update', [ProfileController::class, 'update'])->name('update');
    
    Route::get('{user}/edit-password', [ProfileController::class, 'editPassword'])->name('editPassword');
    Route::patch('{user}/change-password', [ProfileController::class, 'changePassword'])->name('changePassword');

    Route::get('profile-picture', [ProfileController::class, 'changePicture'])->name('picture');
    Route::post('update-profile-picture', [ProfileController::class, 'upload'])->name('upload');
});

<?php

use App\Http\Controllers\User\Api\Auth\AuthController;
use App\Http\Controllers\User\Api\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:user-api'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('update-profile', [ProfileController::class, 'updateProfile'])->name('update.profile');
    Route::post('change-password', [ProfileController::class, 'changePassword'])->name('change.password');
    Route::get('get-profile', [ProfileController::class, 'getProfile'])->name('get.profile');

    Route::resource('notifications', 'NotificationController')->only(['show', 'index', 'destroy']);
});

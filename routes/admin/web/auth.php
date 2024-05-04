<?php

use App\Http\Controllers\Admin\Web\AuthController;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Admin')->group(function () {
    Route::get('login', [AuthController::class, 'loginView'])->name('login.form');
    Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');
});

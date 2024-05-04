<?php

use App\Http\Controllers\Admin\Web\AuthController;
use App\Http\Controllers\Admin\Web\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('profile', [AuthController::class, 'updateProfileView'])->name('profile.view');
Route::put('profile', [AuthController::class, 'updateProfile'])->name('profile.post');
Route::get('home', [HomeController::class, 'index'])->name('home');

Route::resource('admins', 'AdminController');
Route::resource('roles', 'RoleController');
Route::resource('users', 'UserController');
Route::get('admins/toggle-boolean/{id}/{action}', 'AdminController@toggleBoolean')->name('admins.toggleBoolean');

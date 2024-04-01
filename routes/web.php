<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Main\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(["myGuest"])->group(function () {
    // ? Handle Login
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'create')->name('auth.login');
        Route::post('/login', 'store')->name('auth.doLogin');
    });

    // ? Handle Register
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'create')->name('auth.register');
        Route::post('/register', 'store')->name('auth.doRegister');
    });
});

Route::middleware(['myAuth', 'admin'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('admin.dashboard');
    });
});

Route::middleware(['myAuth'])->group(function () {
    // ? Handle Logout
    Route::post('/logout', [LoginController::class, 'destroy'])->name('auth.logout');

    // ? Home Controller
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('main.home');
    });
});

<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

// Auth Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->name('logout');
});

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('forgot-password', 'index')->name('forgot.password');
    Route::post('forgot-password', 'forgotPassword')->middleware('throttle:2,1');
    Route::get('reset-password/{token}', 'resetPasswordVerify')->name('reset.password');
    Route::post('reset-password', 'resetPassword');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('register', 'index')->name('register');
    Route::post('register', 'register');
});


Route::middleware('auth')->group(function () {

    // Dashboard Routes
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
        Route::get('settings', 'setting')->name('setting');
        Route::post('settings', 'settingUpdate');
    });

    Route::controller(UrlController::class)->group(function () {
        Route::get('u/{code}', 'index')->name('url');
        Route::post('shorten', 'shorten')->name('shorten');
    });
});

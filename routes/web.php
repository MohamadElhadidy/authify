<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResendVerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;


Route::middleware('guest')->group(function () {
    Route::view('login', 'auth.login')->name('login');
    Route::post('login', LoginController::class);

    Route::view('register', 'auth.register')->name('register');
    Route::post('register', RegisterController::class);

    Route::view('forgot-password', 'auth.forgot-password')->name('forgot-password');
    Route::post('forgot-password', ForgotPasswordController::class)->middleware('throttle:2,1');

    Route::get('/reset-password', [ResetPasswordController::class, 'create'])->name('reset-password');
    Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('reset-password')->middleware('throttle:2,1');
});



Route::get('/verify-email/{id}', VerifyEmailController::class)
    ->name('verification.verify.custom');


Route::middleware('auth')->group(function () {
    Route::post('logout', LogoutController::class)->name('logout');

    Route::view('/verify-email', 'auth.verify-email')->middleware('auth')->name('verification.notice');
    Route::post('/verify-email', ResendVerificationController::class)->name('verification.send')->middleware('throttle:2,1');
});



Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/', 'home')->name('home');

    Route::view('profile', 'auth.profile')->name('profile');
});

<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResentEmailVerificationController;
use App\Http\Controllers\Auth\VerifyEmailController;

Route::get('/', function () {
    return view('welcome');
})->middleware('verified');


Route::middleware('guest')->group(function () {
    Route::view('login', 'auth.login')->name('login');
    Route::post('login', LoginController::class);

    Route::view('register', 'auth.register')->name('register');
    Route::post('register', RegisterController::class);

    Route::get('/verify-email/{id}', VerifyEmailController::class)
        ->name('verification.verify.custom');


    // Route::post('/verify-email', function (Request $request) {
    //     $request->user()->sendEmailVerificationNotification();

    //     return back()->with('message', 'Verification link sent!');
    // })->middleware(['auth', 'throttle:6,1'])->name('verification.send');


    Route::view('forgot-password', 'auth.forgot-password')->name('forgot-password');
});


Route::middleware('auth')->group(function () {
    Route::post('logout', LogoutController::class)->name('logout');
    
    Route::view('/verify-email', 'auth.verify-email')->middleware('auth')->name('verification.notice');
    Route::post('/verify-email', ResentEmailVerificationController::class)->name('verification.send');
});

<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\MatchController as AdminMatchController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\AllUsersResultController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\UserResultController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('matches.index')
        : redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'updateResetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('change-password.show');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change-password.update');
    Route::get('/matches', [MatchController::class, 'index'])->name('matches.index');
    Route::get('/my-results', [UserResultController::class, 'index'])->name('user-results.index');
    Route::get('/all-users-results', [AllUsersResultController::class, 'index'])->name('all-users-results.index');
    Route::post('/matches/{match}/predict', [PredictionController::class, 'store'])->name('predictions.store');
    Route::post('/payment/request', [PaymentController::class, 'requestPayment'])->name('payment.request');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('matches', AdminMatchController::class)->except(['show']);
        Route::resource('users', AdminUserController::class)->except(['show']);
        Route::put('users/{user}/verify', [AdminUserController::class, 'updateVerify'])->name('users.updateVerify');
        Route::get('re-calculate-scores', [TestController::class, 'reCalculateScores'])->name('admin.reCalculateScores');
    });
});

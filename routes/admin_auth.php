<?php

use App\Http\Controllers\Admin\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminAuth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\AdminAuth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\AdminAuth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\AdminAuth\NewPasswordController;
use App\Http\Controllers\Admin\AdminAuth\PasswordResetLinkController;
use App\Http\Controllers\Admin\AdminAuth\RegisteredUserController;
use App\Http\Controllers\Admin\AdminAuth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

//admin-web
Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('admin.guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('admin.guest')
                ->name('post-register');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('admin.guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('admin.guest')
                ->name('post-login');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('admin.guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('admin.guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('admin.guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('admin.guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('admin')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['admin', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['admin', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('admin')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('admin');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('admin')
                ->name('logout');

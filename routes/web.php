<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactWebController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\VerificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
// Rotas de login e registro
// Login
Route::get('/', [AuthWebController::class, 'loginForm'])->name('login');
Route::get('/login', [AuthWebController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthWebController::class, 'login']);

// Registro
Route::get('/register', [AuthWebController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthWebController::class, 'register']);

// Esqueci a senha
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset de senha
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


// Verificação de e-mail
Route::get('/email/verify', fn() => view('auth.verify-email'))
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout');


// Protegidas por login + verificação
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/contacts', [ContactWebController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/create', [ContactWebController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [ContactWebController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/{id}/edit', [ContactWebController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts/{id}', [ContactWebController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{id}', [ContactWebController::class, 'destroy'])->name('contacts.destroy');
    Route::get('/contacts/export', [ContactWebController::class, 'export'])->name('contacts.export');
});


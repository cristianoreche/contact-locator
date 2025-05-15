<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactWebController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Rotas de login e registro
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Verificação de e-mail
Route::get('/email/verify', fn () => view('auth.verify-email'))
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Protegidas por login + verificação
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/contacts', [ContactWebController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/create', [ContactWebController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [ContactWebController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/{id}/edit', [ContactWebController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts/{id}', [ContactWebController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{id}', [ContactWebController::class, 'destroy'])->name('contacts.destroy');
    Route::get('/contacts/{id}/location', [ContactWebController::class, 'location'])->name('contacts.location');
});

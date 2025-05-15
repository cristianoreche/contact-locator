<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\AuditLogController;

// Login e registro 
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Endereço 
Route::middleware('auth:sanctum')->get('/address/search', [AddressController::class, 'search']);

// Rotas protegidas por token
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::delete('/delete-account', [AuthController::class, 'deleteAccount']);
    Route::get('/contacts', [ContactController::class, 'index']);
    Route::post('/contacts', [ContactController::class, 'store']);
    Route::put('/contacts/{id}', [ContactController::class, 'update']);
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);
});

// Localização 
Route::middleware('auth:sanctum')->get('/contacts/{id}/location', [ContactController::class, 'showLocation']);
Route::middleware('auth:sanctum')->get('/contacts/{id}', [ContactController::class, 'show']);
Route::middleware('auth:sanctum')->get('/audit-logs', [AuditLogController::class, 'index']);

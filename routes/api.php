<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SignatureRequestController;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);

// Protected Routes - Require Authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [LoginController::class, 'logout']);

    // Signature Process Routes
    Route::get('signature-requests/{id}/status', [SignatureRequestController::class, 'showStatus']);
    Route::get('signature-requests', [SignatureRequestController::class, 'index']);
    Route::get('my-requests', [SignatureRequestController::class, 'myRequests']);
    Route::post('signature-requests', [SignatureRequestController::class, 'requestSignature']);
    Route::post('signature-requests/{id}/sign', [SignatureRequestController::class, 'signDocument']);

    // Document Routes
    Route::post('documents', [DocumentController::class, 'upload']);
});

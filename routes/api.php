<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SignatureRequestController;

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('signature-requests/{id}/status', [SignatureRequestController::class, 'showStatus']);
    Route::get('signature-requests', [SignatureRequestController::class, 'index']);
    Route::get('my-requests', [SignatureRequestController::class, 'myRequests']);
    Route::post('signature-requests', [SignatureRequestController::class, 'requestSignature']);
    Route::post('signature-requests/{id}/sign', [SignatureRequestController::class, 'signDocument']);
    Route::post('documents', [DocumentController::class, 'upload']);

});


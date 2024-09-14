<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ParticipantController;
use App\Http\Controllers\Api\ScanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/participants', [ParticipantController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/list_scan', [ScanController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post("scan", [ScanController::class, "scan_qr"]);
});

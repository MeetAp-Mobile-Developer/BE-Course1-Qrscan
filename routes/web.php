<?php

use App\Http\Controllers\Api\ParticipantController;
use App\Http\Controllers\ParticipantController as ControllersParticipantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register-participant', function () {
    return view('register-participant');
});
// Rute untuk menangani form pendaftaran peserta
Route::post('/register', [ParticipantController::class, 'store'])->name('participants.store');

Route::prefix("participant")->name("participant")->group(function () {
    Route::get("/register", [ControllersParticipantController::class, "register"])->name('.register');
    Route::post("/register", [ControllersParticipantController::class, "register_store"]);
});

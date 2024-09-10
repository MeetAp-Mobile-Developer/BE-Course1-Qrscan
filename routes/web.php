<?php

use App\Http\Controllers\Api\ParticipantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return view('register');
});
// Rute untuk menangani form pendaftaran peserta
Route::post('/register', [ParticipantController::class, 'store'])->name('participants.store');

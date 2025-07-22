<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkingSessionController;

Route::get('/parking-sessions', [ParkingSessionController::class, 'index'])->name('parking-sessions.index');
Route::post('/parking-sessions', [ParkingSessionController::class, 'store'])->name('parking-sessions.store');
Route::patch('/parking-sessions/{session}', [ParkingSessionController::class, 'update'])->name('parking-sessions.update');

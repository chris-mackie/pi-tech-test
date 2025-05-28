<?php

use App\Http\Controllers\ParkingSessionController;

Route::post('/parking-sessions', [ParkingSessionController::class, 'store'])->name('parking-sessions.store');
Route::patch('/parking-sessions/{session}', [ParkingSessionController::class, 'update'])->name('parking-sessions.update');

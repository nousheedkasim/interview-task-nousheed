<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\EventSessionController;
use App\Http\Controllers\Api\SpeakerController;

Route::name('api.')->group(function () {
// Events
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/speakers', [SpeakerController::class, 'index']);
    Route::get('/sessions', [EventSessionController::class, 'index']);


    Route::put('/events/{id}', [EventController::class, 'update']);
    Route::delete('/events/{id}', [EventController::class, 'destroy']);

    // Sessions
    Route::apiResource('sessions', EventSessionController::class);

    // Speakers
    Route::apiResource('speakers', SpeakerController::class);
});

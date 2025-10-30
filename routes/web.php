<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventSessionController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\EventSessionSpeakerController;

Route::get('/', function () {
    return view('login');
});
// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('events', EventController::class);
    Route::resource('sessions', EventSessionController::class);
    Route::resource('speakers', SpeakerController::class);
    Route::resource('event_session_speaker', EventSessionSpeakerController::class);
    
    Route::get('/event/{event}/related-data', [EventSessionSpeakerController::class, 'getRelatedData'])
    ->name('event.related-data');

});

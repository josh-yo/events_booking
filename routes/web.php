<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganiserController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/events/createEvent', [EventController::class, 'create'])->name('events.createEvent');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');

    Route::get('/dashboard', [OrganiserController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');

    Route::delete('/events/{id}', [EventController::class, 'destroy'])
    ->middleware('auth')
    ->name('events.destroy');
});

// Public Routes
Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::view('/privacy', 'privacy')->name('privacy');

require __DIR__.'/auth.php';

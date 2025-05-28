<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

// Redirect root to events
Route::redirect('/', '/events');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Protected routes
Route::middleware('auth')->group(function () {
    // Events CRUD
    Route::resource('events', EventController::class);

    // Register for event
    Route::post('/events/{event}/register', [RegistrationController::class, 'store'])->name('events.register');

    // Cancel registration (UNREGISTER)
    Route::delete('/events/{event}/unregister', [RegistrationController::class, 'destroy'])->name('events.unregister');

    // View profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Edit profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

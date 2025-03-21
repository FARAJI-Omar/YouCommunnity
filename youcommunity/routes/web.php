<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RSVPController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'welcome']);

Route::get('/dashboard', [EventController::class, 'homePageEvents'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::delete('events/my/{event}/destroy', [EventController::class, 'destroyMy'])->name('events.my.destroy');
    Route::get('events/my/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::patch('events/my/{event}', [EventController::class, 'update'])->name('events.update');

    Route::get('events/my', [EventController::class, 'myEvents'])->name('events.my');

    Route::resource('events', EventController::class);

    Route::get('events/{event}', [EventController::class, 'show'])->name('events.details');

    Route::post('events/{event}/rsvp', [RSVPController::class, 'store'])->name('rsvp.store');
    Route::delete('events/{event}/rsvp', [RSVPController::class, 'destroy'])->name('rsvp.destroy');

    Route::post('events/{event}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__ . '/auth.php';

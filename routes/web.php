<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\WeddingController;
use App\Http\Controllers\WishController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

/**
 * Public Invitation Routes
 * These routes are publicly accessible without authentication
 */
Route::prefix('inv')->name('invitations.')->group(function () {
    // Wedding invitation page: /inv/{wedding:slug}
    Route::get('{wedding:slug}', [WeddingController::class, 'show'])
        ->name('show');

    // Guest RSVP page: /inv/{wedding:slug}/{guest:uuid}
    Route::get('{wedding:slug}/{guest:uuid}', [GuestController::class, 'show'])
        ->name('guest.show');

    // Update RSVP: POST /inv/{wedding:slug}/{guest:uuid}/rsvp
    Route::post('{wedding:slug}/{guest:uuid}/rsvp', [GuestController::class, 'updateRsvp'])
        ->name('guest.update-rsvp');

    // Wishes list: /inv/{wedding:slug}/wishes
    Route::get('{wedding:slug}/wishes', [WishController::class, 'index'])
        ->name('wishes.index');

    // Store wish: POST /inv/{wedding:slug}/wishes
    Route::post('{wedding:slug}/wishes', [WishController::class, 'store'])
        ->name('wishes.store');
});

require __DIR__.'/admin.php';
require __DIR__.'/settings.php';

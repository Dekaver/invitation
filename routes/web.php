<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\WeddingController;
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
        
    Route::get('{wedding:slug}/share', [GuestController::class, 'share'])
        ->name('guest.share');

    // Guest RSVP page: /inv/{wedding:slug}/{guest:uuid}
    Route::get('{wedding:slug}/{guest:uuid}', [GuestController::class, 'show'])
        ->name('guest.show');


    // Update RSVP: POST /inv/{wedding:slug}/{guest:uuid}/rsvp
    Route::post('{wedding:slug}/guest', [GuestController::class, 'store'])
        ->name('guest.store');
});

require __DIR__.'/admin.php';
require __DIR__.'/settings.php';

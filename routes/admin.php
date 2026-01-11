<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GuestCrudController;
use App\Http\Controllers\Admin\WeddingCrudController;
use App\Http\Controllers\Admin\WishCrudController;
use App\Models\Wedding;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/**
 * Admin Routes - Protected by auth middleware
 */
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Wedding CRUD
    Route::resource('weddings', WeddingCrudController::class);

    // Wedding Wizard (step-by-step creation)
    Route::get('weddings/create/wizard', function () {
        return view('admin.weddings.create-wizard', [
            'title' => 'Buat Undangan Pernikahan'
        ]);
    })->name('weddings.create.wizard');

    // Guest CRUD (nested under wedding)
    Route::resource('weddings.guests', GuestCrudController::class)
        ->except(['show']);

    // Wish management (view and delete only)
    Route::resource('weddings.wishes', WishCrudController::class)
        ->only(['index', 'destroy']);
});


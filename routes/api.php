<?php

use App\Http\Controllers\Api\WeddingApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Protected API routes for admin functionality
Route::middleware(['auth', 'verified'])->prefix('admin')->name('api.admin.')->group(function () {
    // Wedding API endpoints
    Route::prefix('weddings')->name('weddings.')->group(function () {
        Route::post('/', [WeddingApiController::class, 'store'])->name('store');
    });
});
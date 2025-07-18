<?php

use App\Http\Controllers\StampController;
use Illuminate\Support\Facades\Route;

// Main wall to display stamps
Route::get('/', [StampController::class, 'showWall'])->name('wall');

// Create stamp routes (display form and handle submission)
Route::get('/create-stamp', [StampController::class, 'showCreateForm'])->name('create-stamp');
Route::post('/create-stamp', [StampController::class, 'storeStamp'])->name('store-stamp');

// Edit stamp routes (display form and handle submission)
Route::get('/edit-stamp/{intStampId}', [StampController::class, 'showEditForm'])->name('edit-stamp');
Route::post('/edit-stamp/{intStampId}', [StampController::class, 'updateStamp'])->name('update-stamp');

// Delete stamp
Route::post('/delete-stamp/{intStampId}', [StampController::class, 'deleteStamp'])->name('delete-stamp');

// Endpoint for infinite scroll
Route::get('/load-more-stamps', [StampController::class, 'loadMoreStamps'])->name('load-more-stamps');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StampController;

Route::get('/', [StampController::class, 'showWall'])->name('wall');
Route::get('/create-stamp', [StampController::class, 'showCreateForm'])->name('create-stamp');
Route::post('/create-stamp', [StampController::class, 'storeStamp'])->name('store-stamp');
Route::get('/edit-stamp/{intStampId}', [StampController::class, 'showEditForm'])->name('edit-stamp');
Route::post('/edit-stamp/{intStampId}', [StampController::class, 'updateStamp'])->name('update-stamp');
Route::post('/delete-stamp/{intStampId}', [StampController::class, 'deleteStamp'])->name('delete-stamp');
Route::get('/load-more-stamps', [StampController::class, 'loadMoreStamps'])->name('load-more-stamps');
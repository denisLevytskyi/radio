<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PropController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\FreqController;
use App\Http\Controllers\RecordController;

Route::name('app.')->middleware(['auth', 'verified', 'isGuest'])->group(function() {
    Route::resource('admin', AdminController::class)->middleware('isAdministrator');
    Route::resource('prop', PropController::class)->middleware('isAdministrator');
    Route::get('import', [ImportController::class, 'import'])->name('import')->middleware(['ftp', 'isUser']);
    Route::resource('freq', FreqController::class)->middleware('checkAppMode');
    Route::resource('record', RecordController::class);
    Route::any('record-search/{freq?}', [RecordController::class, 'search'])->name('record.search');
});

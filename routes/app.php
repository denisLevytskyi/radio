<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PropController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\RecorderController;
use App\Http\Controllers\FreqController;
use App\Http\Controllers\RecordController;

Route::name('app.')->middleware(['auth', 'verified', 'isGuest'])->group(function() {
    Route::resource('admin', AdminController::class)->middleware('isAdministrator');
    Route::resource('prop', PropController::class)->middleware('isAdministrator');
    Route::get('import', [ImportController::class, 'import'])->name('import')->middleware(['ftp', 'isUser']);
    Route::get('recorder', [RecorderController::class, 'index'])->name('recorder')->middleware('isRecorder');
    Route::post('recorder', [RecorderController::class, 'terminal'])->middleware('isRecorder');
    Route::resource('freq', FreqController::class)->middleware('checkAppMode');
    Route::resource('record', RecordController::class);
    Route::any('record-search/{freq?}', [RecordController::class, 'search'])->name('record.search');
});

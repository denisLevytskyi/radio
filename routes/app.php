<?php

use App\Http\Controllers\FreqController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\RecorderController;
use App\Http\Controllers\PropController;
use App\Http\Controllers\AdminController;

Route::name('app.')->middleware(['auth', 'verified', 'isGuest'])->group(function() {
    Route::resource('freq', FreqController::class)->middleware('isPassStrongMod');
    Route::resource('record', RecordController::class);
    Route::get('record-audio/{record}', [RecordController::class, 'getAudio'])->name('record.audio');
    Route::any('record-search/{freq?}', [RecordController::class, 'search'])->name('record.search');
    Route::get('import', [ImportController::class, 'import'])->name('import')->middleware('isUser');
    Route::get('recorder', [RecorderController::class, 'index'])->name('recorder.index')->middleware('isRecorder');
    Route::post('recorder', [RecorderController::class, 'store'])->name('recorder.store')->middleware('isRecorder');
    Route::resource('prop', PropController::class)->middleware('isAdministrator');
    Route::resource('admin', AdminController::class)->middleware('isAdministrator');
});

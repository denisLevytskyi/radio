<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PropController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ManualConnectController;
use App\Http\Controllers\RecorderController;
use App\Http\Controllers\AutoloaderController;
use App\Http\Controllers\FreqController;
use App\Http\Controllers\RecordController;

Route::name('app.')->middleware(['auth', 'verified', 'isGuest'])->group(function() {
    Route::resource('admin', AdminController::class)->middleware('isAdministrator');
    Route::resource('prop', PropController::class)->middleware('isAdministrator');
    Route::get('import', [ImportController::class, 'import'])->name('import')->middleware('isUser');
    Route::get('manual-connect', [ManualConnectController::class, 'index'])->name('manual.connect.index')->middleware('isRecorder');
    Route::post('manual-connect', [ManualConnectController::class, 'store'])->name('manual.connect.store')->middleware('isRecorder');
    Route::get('recorder', [RecorderController::class, 'index'])->name('recorder.index')->middleware('isRecorder');
    Route::post('recorder', [RecorderController::class, 'store'])->name('recorder.store')->middleware('isRecorder');
    Route::get('autoloader', [AutoloaderController::class, 'index'])->name('autoloader.index')->middleware('isRecorder');
    Route::get('autoloader-store', [ImportController::class, 'import'])->name('autoloader.store')->middleware('isRecorder');
    Route::resource('freq', FreqController::class)->middleware('isPassStrongMod');
    Route::resource('record', RecordController::class);
    Route::any('record-search/{freq?}', [RecordController::class, 'search'])->name('record.search');
});

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PropController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ManualImportController;
use App\Http\Controllers\ImporterController;
use App\Http\Controllers\RecorderController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ManualExportController;
use App\Http\Controllers\ExporterController;
use App\Http\Controllers\FreqController;
use App\Http\Controllers\RecordController;

Route::name('app.')->middleware(['auth', 'verified', 'isGuest'])->group(function() {
    Route::resource('admin', AdminController::class)->middleware('isAdministrator');
    Route::resource('prop', PropController::class)->middleware('isAdministrator');
    Route::get('import', [ImportController::class, 'import'])->name('import')->middleware('isUser');
    Route::get('manual-import', [ManualImportController::class, 'index'])->name('manual.import.index')->middleware('isRecorder');
    Route::post('manual-import', [ManualImportController::class, 'store'])->name('manual.import.store')->middleware('isRecorder');
    Route::get('importer', [ImporterController::class, 'index'])->name('importer.index')->middleware('isRecorder');
    Route::get('importer-store', [ImportController::class, 'import'])->name('importer.store')->middleware('isRecorder');
    Route::get('recorder', [RecorderController::class, 'index'])->name('recorder.index')->middleware('isRecorder');
    Route::post('recorder', [RecorderController::class, 'store'])->name('recorder.store')->middleware('isRecorder');
    Route::get('export', [ExportController::class, 'export'])->name('export')->middleware('isExporter');
    Route::get('manual-export', [ManualExportController::class, 'index'])->name('manual.export.index')->middleware('isExporter');
    Route::post('manual-export', [ManualExportController::class, 'store'])->name('manual.export.store')->middleware('isExporter');
    Route::get('exporter', [ExporterController::class, 'index'])->name('exporter.index')->middleware('isExporter');
    Route::get('exporter-store', [ExportController::class, 'export'])->name('exporter.store')->middleware('isExporter');
    Route::resource('freq', FreqController::class)->middleware('isPassStrongMod');
    Route::resource('record', RecordController::class);
    Route::any('record-search/{freq?}', [RecordController::class, 'search'])->name('record.search');
});

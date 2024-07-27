<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PropController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\FreqController;

Route::name('app.')->middleware(['auth', 'verified', 'isGuest'])->group(function() {
    Route::resource('admin', AdminController::class)->middleware('isAdministrator');
    Route::resource('prop', PropController::class)->middleware('isAdministrator');
    Route::get('import', [ImportController::class, 'import'])->name('import')->middleware('isUser');
    Route::resource('freq', FreqController::class);
});

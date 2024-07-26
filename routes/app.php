<?php

use App\Http\Controllers\AdminController;

Route::name('app.')->middleware(['auth', 'verified', 'isGuest'])->group(function() {
    Route::resource('admin', AdminController::class)->middleware('isAdministrator');
});

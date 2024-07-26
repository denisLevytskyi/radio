<?php
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('_lvz.main');
})->middleware(['auth', 'verified']);

Route::get('/_migration', function () {
    $a = Artisan::call('migrate:fresh');
    $b = Artisan::call('db:seed');
    dd($a, $b);
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile', [PasswordController::class, 'update'])->name('profile.password.update');
});

require __DIR__.'/auth.php';
require __DIR__.'/app.php';

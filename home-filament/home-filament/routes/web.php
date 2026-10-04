<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/locale/{locale}', LocaleController::class)->name('locale');


Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')
    ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');

    Route::post('/logout', LogoutController::class)->name('logout');
});

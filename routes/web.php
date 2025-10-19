<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('calendar', [BookingController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('bookings', BookingController::class)->except(['edit', 'show', 'create']);

Route::get('/dashboard', [BookingController::class, 'index'])->middleware(['auth', 'verified']);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
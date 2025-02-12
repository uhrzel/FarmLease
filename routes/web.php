<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', fn() => view('welcome'));
Route::middleware(['auth', 'verified'])->group(function () {
    /* Default */
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Role-Based for tenant and lessee
    Route::get('/home', fn() => view('users.' . Auth::user()->role . '.home'))->name('home');
    Route::get('/about', fn() => view('users.' . Auth::user()->role . '.about'))->name('about');
    Route::get('/faqs', fn() => view('users.' . Auth::user()->role . '.faqs'))->name('faqs');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

// Include Authentication Routes
require __DIR__ . '/auth.php';

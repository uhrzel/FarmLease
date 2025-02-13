<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', fn() => view('welcome'));

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    // Role-Based Navigation
    Route::get('/home', function () {
        $role = Auth::user()->role;
        if ($role === 'land_owner') {
            return view('users.landowner.home');
        } else if ($role === 'admin') {
            return view('users.admin.home');
        }
        return view("users.$role.home");
    })->name('home');
    // Only for tenant & lessee
    Route::get('/about', fn() => view("users." . Auth::user()->role . ".about"))->name('about')
        ->where('role', 'tenant|lessee');
    Route::get('/faqs', fn() => view("users." . Auth::user()->role . ".faqs"))->name('faqs')
        ->where('role', 'tenant|lessee');

    // Route for Landowner Statistics
    Route::get('/landowner/stats', fn() => view('users.landowner.stats'))
        ->middleware('auth')
        ->name('stats');

    // Route for Superadmin
    Route::get('/superadmin/users', fn() => view('users.superadmin.users'))
        ->middleware('auth')
        ->name('users');
    Route::get('/superadmin/generate_form', fn() => view('users.superadmin.generate_form'))
        ->middleware('auth')
        ->name('generate_form');
    Route::get('/superadmin/land_posting', fn() => view('users.superadmin.land_posting'))
        ->middleware('auth')
        ->name('land_posting');
    Route::get('/superadmin/transactions', fn() => view('users.superadmin.transactions'))
        ->middleware('auth')
        ->name('transactions');
    Route::get('/superadmin/feedbacks', fn() => view('users.superadmin.feedbacks'))
        ->middleware('auth')
        ->name('feedbacks');
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

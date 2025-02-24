<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LandListingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;

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
            return app(\App\Http\Controllers\LandListingController::class)->admin();
        } else if ($role === 'tenant') {
            return app(\App\Http\Controllers\LandListingController::class)->tenant();
        } else if ($role === 'lessee') {
            return app(\App\Http\Controllers\LandListingController::class)->lessee();
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
    Route::post('/land-listings', [LandListingController::class, 'store'])->name('landlistings.store')
        ->middleware('auth')
        ->where('role', 'land_owner');



    // Route for Superadmin
    Route::get('/superadmin/users', [UserController::class, 'showUsers'])->middleware('auth')->name('users');
    Route::get('/superadmin/generate_form', [UserController::class, 'userReport'])
        ->middleware('auth')
        ->name('generate_form');
    Route::get('/superadmin/land_posting', [LandListingController::class, 'index'])->name('land_posting');
    Route::get('/superadmin/transactions', [TransactionController::class, 'transactions'])->name('transactions');
    Route::get('/superadmin/feedbacks', fn() => view('users.superadmin.feedbacks'))
        ->middleware('auth')
        ->name('feedbacks');

    //Route for admin 
    Route::get('/admin/land-listings', [LandListingController::class, 'admin'])
        ->name('admin.landlistings')
        ->middleware('auth');
    Route::get('/landlistings/new', [LandListingController::class, 'newListings'])->name('landlistings.new');
    Route::get('/landlistings/{id}', [LandListingController::class, 'show']);
    Route::post('/landlistings/{id}/approve', [LandListingController::class, 'approve']);
    Route::post('/landlistings/{id}/decline', [LandListingController::class, 'decline']);

    // Route for Tenant
    /*    Route::get('/admin/land-listings', [LandListingController::class, 'admin'])
        ->name('admin.landlistings')
        ->middleware('auth'); */


    /* Rent now */
    //Tenant Lessee Cart
    Route::get('/tenant/cart', [CartController::class, 'index'])->name('cart.tenant.index');
    Route::get('/lessee/cart', [CartController::class, 'lessee'])->name('cart.lessee.index');
    Route::post('/cart/add', [CartController::class, 'store'])->middleware('auth')->name('cart.add');
    Route::post('/payment/process/{cart}', [PaymentController::class, 'processPayment'])->name('payment.process');
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

<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Frontdesk\AuthController as FrontdeskAuthController;
use App\Http\Controllers\Frontdesk\DashboardController as FrontdeskDashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ============================================
// ADMIN ROUTES (Internal - No Register)
// ============================================
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest routes (not logged in)
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected routes (logged in)
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    });
});

// ============================================
// FRONTDESK ROUTES (Internal - No Register)
// ============================================
Route::prefix('frontdesk')->name('frontdesk.')->group(function () {
    // Guest routes (not logged in)
    Route::get('/login', [FrontdeskAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [FrontdeskAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [FrontdeskAuthController::class, 'logout'])->name('logout');

    // Protected routes (logged in)
    Route::middleware('auth:frontdesk')->group(function () {
        Route::get('/dashboard', [FrontdeskDashboardController::class, 'index'])->name('dashboard');
    });
});

require __DIR__.'/auth.php';
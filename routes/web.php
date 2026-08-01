<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Frontdesk\AuthController as FrontdeskAuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// ============================================
// PUBLIC ROUTES
// ============================================
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

// ============================================
// USER AUTH ROUTES (Vue - from Breeze)
// ============================================
// These are already defined in routes/auth.php

// ============================================
// ADMIN ROUTES (Vue)
// ============================================
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest routes (not logged in)
    Route::get('/login', function () {
        return Inertia::render('Admin/Login');
    })->name('login');
    
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected routes (logged in)
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('dashboard');
    });
});

// ============================================
// FRONTDESK ROUTES (Vue)
// ============================================
Route::prefix('frontdesk')->name('frontdesk.')->group(function () {
    // Guest routes (not logged in)
    Route::get('/login', function () {
        return Inertia::render('Frontdesk/Login');
    })->name('login');
    
    Route::post('/login', [FrontdeskAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [FrontdeskAuthController::class, 'logout'])->name('logout');

    // Protected routes (logged in)
    Route::middleware('auth:frontdesk')->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Frontdesk/Dashboard');
        })->name('dashboard');
    });
});

require __DIR__.'/auth.php';
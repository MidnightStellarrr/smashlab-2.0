<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Frontdesk\AuthController as FrontdeskAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// ============================================
// USER ROUTES (Public)
// ============================================
Route::get('/', function () {
    return Inertia::render('User/Welcome');
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('User/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/book_now', function () {
    return Inertia::render('User/book_now');
})->name('book.now');

Route::get('/classes', function () {
    return Inertia::render('User/classes');
})->name('classes');

Route::get('/classes/beginner_class', function () {
    return Inertia::render('User/classes/beginner_class');
})->name('classes.beginner');

Route::get('/classes/intermediate_class', function () {
    return Inertia::render('User/classes/intermediate_class');
})->name('classes.intermediate');

Route::get('/classes/advanced_class', function () {
    return Inertia::render('User/classes/advanced_class');
})->name('classes.advanced');

Route::get('/classes/enroll', function () {
    return Inertia::render('User/classes/enroll');
})->name('classes.enroll');



// ============================================
// USER PROFILE ROUTES (Authenticated)
// ============================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return Inertia::render('User/Profile/Edit');
    })->name('profile.edit');
    
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ============================================
// ADMIN ROUTES
// ============================================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', function () {
        return Inertia::render('Admin/Login');
    })->name('login');
    
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('dashboard');
    });
});

// ============================================
// FRONTDESK ROUTES
// ============================================
Route::prefix('frontdesk')->name('frontdesk.')->group(function () {
    Route::get('/login', function () {
        return Inertia::render('Frontdesk/Login');
    })->name('login');
    
    Route::post('/login', [FrontdeskAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [FrontdeskAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:frontdesk')->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Frontdesk/Dashboard');
        })->name('dashboard');
    });
});

require __DIR__.'/auth.php';
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Api\CheckController;
use App\Http\Controllers\Admin\SantriController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', function () {
    return view('public.landing');
})->name('home');

// Registration Routes
Route::prefix('registration')->name('registration.')->group(function () {
    Route::get('/', [RegistrationController::class, 'create'])->name('create');
    Route::post('/', [RegistrationController::class, 'store'])->name('store');
    Route::get('/success/{nomor}', [RegistrationController::class, 'success'])->name('success');
});

// Status Check
Route::get('/status', function () {
    return view('public.status-check');
})->name('status.check');

// Static Pages
Route::get('/about', function () {
    return view('public.about');
})->name('about');

Route::get('/requirements', function () {
    return view('public.requirements');
})->name('requirements');

Route::get('/faq', function () {
    return view('public.faq');
})->name('faq');

Route::get('/contact', function () {
    return view('public.contact');
})->name('contact');

Route::get('/privacy', function () {
    return view('public.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('public.terms');
})->name('terms');

Route::get('/sitemap', function () {
    return view('public.sitemap');
})->name('sitemap');

/*
|--------------------------------------------------------------------------
| API Routes (for AJAX)
|--------------------------------------------------------------------------
*/
Route::prefix('api')->group(function () {
    Route::get('/check-nik', [CheckController::class, 'checkNik']);
    Route::get('/check-email', [CheckController::class, 'checkEmail']);
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Santri Management
    Route::prefix('santri')->name('santri.')->group(function () {
        Route::get('/', [SantriController::class, 'index'])->name('index');
        Route::get('/data', [SantriController::class, 'getData'])->name('data');
        Route::get('/{id}', [SantriController::class, 'show'])->name('show');
        Route::post('/{id}/verify', [SantriController::class, 'verify'])->name('verify');
        Route::post('/{id}/accept', [SantriController::class, 'accept'])->name('accept');
        Route::post('/{id}/reject', [SantriController::class, 'reject'])->name('reject');
        Route::delete('/{id}', [SantriController::class, 'destroy'])->name('destroy');
        Route::get('/export/excel', [SantriController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [SantriController::class, 'exportPdf'])->name('export.pdf');
    });

    // Verification
    Route::get('/verification', [AdminController::class, 'verification'])->name('verification.index');

    // Payment
    Route::get('/payment', [AdminController::class, 'payment'])->name('payment.index');

    // Reports
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports.index');

    // Exports
    Route::get('/exports', function () {
        return view('admin.exports.index');
    })->name('exports.index');

    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings.index');

    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');

    // Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
});

/*
|--------------------------------------------------------------------------
| Santri Routes (Authenticated)
|--------------------------------------------------------------------------
*/
Route::prefix('santri')->name('santri.')->group(function () {
    Route::get('/login', function () {
        return view('auth.santri-login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'santriLogin']);
});

// Admin Login
Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('login');
Route::prefix('santri')->name('santri.')->middleware(['auth:santri', 'santri'])->group(function () {
    Route::get('/dashboard', function () {
        return view('santri.dashboard');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('santri.profile');
    })->name('profile');
});

// Auth Routes for Admin
Route::get('/admin/login', function () {
    return view('auth.admin-login');
})->name('admin.login')->middleware('guest');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Fallback
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

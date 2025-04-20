<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\InfaqController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\ItikafFormController;
use App\Http\Controllers\Admin\ItikafController;

// Route untuk menampilkan form Itikaf (public)
Route::get('/itikaf-form/{programId}', [ItikafFormController::class, 'create'])->name('public.itikaf.form');

// Route untuk menyimpan data Itikaf (public)
Route::post('/itikaf-form/{programId}', [ItikafFormController::class, 'store'])->name('public.itikaf.submit');
// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kalender', function () {
    return view('partials.calendar');
})->name('kalender');
Route::get('/artikel', [HomeController::class, 'artikel'])->name('artikel');
Route::get('/infaq', [InfaqController::class, 'index'])->name('infaq');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/kajian/{category}', [HomeController::class, 'showVideosByCategory'])
     ->name('kajian.category');
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

// Admin panel routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    // Main admin dashboard (single page view)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/itikaf', [ItikafController::class, 'index'])->name('itikaf.index');
    // Di file routes/web.php
    Route::get('/itikaf/{id}', [ItikafController::class, 'show']);
    Route::get('/itikaf/download/{format}', [ItikafController::class, 'download'])->name('itikaf.download');

    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name ('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    // Announcements routes
    Route::prefix('announcements')->group(function () {
        Route::get('/', [AnnouncementController::class, 'index'])->name('announcements.index');
        Route::get('/create', [AnnouncementController::class, 'create'])->name('announcements.create');
        Route::post('/', [AnnouncementController::class, 'store'])->name('announcements.store');
        Route::get('/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
        Route::put('/{announcement}', [AnnouncementController::class, 'update'])->name('announcements.update');
        Route::delete('/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
    });

    // Programs routes
    Route::prefix('programs')->group(function () {
        Route::get('/', [ProgramController::class, 'index'])->name('programs.index');
        Route::get('/create', [ProgramController::class, 'create'])->name('programs.create');
        Route::post('/', [ProgramController::class, 'store'])->name('programs.store');
        Route::get('/{program}/edit', [ProgramController::class, 'edit'])->name('programs.edit');
        Route::put('/{program}', [ProgramController::class, 'update'])->name('programs.update');
        Route::delete('/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy');
    });

    // Galleries routes
    Route::prefix('galleries')->group(function () {
        Route::get('/', [GaleriController::class, 'index'])->name('galleries.index');
        Route::get('/create', [GaleriController::class, 'create'])->name('galleries.create');
        Route::post('/', [GaleriController::class, 'store'])->name('galleries.store');
        Route::get('/{gallery}/edit', [GaleriController::class, 'edit'])->name('galleries.edit');
        Route::put('/{gallery}', [GaleriController::class, 'update'])->name('galleries.update');
        Route::delete('/{gallery}', [GaleriController::class, 'destroy'])->name('galleries.destroy');
    });

    // Videos routes
    Route::prefix('video')->group(function () {
        Route::get('/', [VideoController::class, 'index'])->name('videos.index');
        Route::get('/create', [VideoController::class, 'create'])->name('videos.create');
        Route::post('/', [VideoController::class, 'store'])->name('videos.store');
        Route::get('/{video}/edit', [VideoController::class, 'edit'])->name('videos.edit');
        Route::put('/{video}', [VideoController::class, 'update'])->name('videos.update');
        Route::delete('/{video}', [VideoController::class, 'destroy'])->name('videos.destroy');
    });
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

require __DIR__.'/auth.php';
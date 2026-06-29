<?php

/*
 * routes/web.php
 * Routing untuk semua halaman web aplikasi
 * Menggunakan Laravel routing dengan controller
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

// Route untuk halaman publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');

// Route untuk autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Route yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/api/ringkasan-kas', [DashboardController::class, 'ringkasanKas'])->name('ringkasan-kas');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Kas Masuk
    Route::prefix('kas-masuk')->group(function () {
        Route::get('/', [TransactionController::class, 'kasMasukIndex'])->name('kas-masuk.index');
        Route::get('/create', [TransactionController::class, 'kasMasukCreate'])->name('kas-masuk.create');
        Route::post('/', [TransactionController::class, 'kasMasukStore'])->name('kas-masuk.store');
        Route::get('/{id}/edit', [TransactionController::class, 'edit'])->name('kas-masuk.edit');
        Route::put('/{id}', [TransactionController::class, 'update'])->name('kas-masuk.update');
        Route::delete('/{id}', [TransactionController::class, 'destroy'])->name('kas-masuk.destroy');
        Route::get('/api/generate-kode', [TransactionController::class, 'generateKode'])->name('generate-kode');
    });

    // Kas Keluar
    Route::prefix('kas-keluar')->group(function () {
        Route::get('/', [TransactionController::class, 'kasKeluarIndex'])->name('kas-keluar.index');
        Route::get('/create', [TransactionController::class, 'kasKeluarCreate'])->name('kas-keluar.create');
        Route::post('/', [TransactionController::class, 'kasKeluarStore'])->name('kas-keluar.store');
        Route::get('/{id}/edit', [TransactionController::class, 'edit'])->name('kas-keluar.edit');
        Route::put('/{id}', [TransactionController::class, 'update'])->name('kas-keluar.update');
        Route::delete('/{id}', [TransactionController::class, 'destroy'])->name('kas-keluar.destroy');
    });

    // Laporan
    Route::prefix('laporan')->group(function () {
        Route::get('/jurnal-umum', [ReportController::class, 'jurnalUmum'])->name('laporan.jurnal-umum');
        Route::get('/buku-besar', [ReportController::class, 'bukuBesar'])->name('laporan.buku-besar');
        Route::get('/neraca', [ReportController::class, 'neraca'])->name('laporan.neraca');
        Route::get('/laba-rugi', [ReportController::class, 'labaRugi'])->name('laporan.laba-rugi');
        Route::get('/export/{tipe}', [ReportController::class, 'export'])->name('laporan.export');
    });
});

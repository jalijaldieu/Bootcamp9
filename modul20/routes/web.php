<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Dashboard utama — ringkasan jumlah produk, kategori, dan klik produk
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Route khusus admin — dilindungi middleware 'admin' (harus login + role admin)
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', function () {
        return 'Halaman ini hanya bisa diakses oleh admin.';
    })->name('admin.index');

    // Tambahkan route-route khusus admin lainnya di sini
    // Route::get('/admin/users', [AdminUserController::class, 'index']);

});

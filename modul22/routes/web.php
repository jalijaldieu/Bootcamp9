<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard — sekarang pakai DashboardController (ringkasan produk/kategori/klik)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route bawaan Breeze untuk profil user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route khusus admin — dilindungi middleware 'admin' (harus login + role admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function () {
        return redirect()->route('admin.users.index');
    })->name('index');

    // Halaman kelola role user
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');

});

// Halaman tambah produk & kategori produk (perlu login)
Route::middleware('auth')->group(function () {
    Route::resource('product-category', ProductCategoryController::class)->only(['create', 'store']);
    Route::resource('product', ProductController::class)->only(['create', 'store']);
});

require __DIR__.'/auth.php';

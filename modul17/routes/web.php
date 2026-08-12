<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Tambahkan baris-baris di bawah ini ke routes/web.php project Anda

Route::redirect('/', '/products');

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

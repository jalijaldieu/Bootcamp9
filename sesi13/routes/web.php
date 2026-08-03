<?php

use Illuminate\Support\Facades\Route;

// Data produk contoh (biasanya dari database)
$products = [
    ['id' => 1, 'name' => 'Kaos Polos', 'description' => 'Kaos katun nyaman untuk sehari-hari.', 'price' => 75000],
    ['id' => 2, 'name' => 'Celana Jeans', 'description' => 'Celana jeans model slim fit.', 'price' => 250000],
    ['id' => 3, 'name' => 'Sepatu Sneakers', 'description' => 'Sepatu casual serbaguna.', 'price' => 350000],
    ['id' => 4, 'name' => 'Topi Baseball', 'description' => 'Topi keren untuk gaya kasual.', 'price' => 60000],
    ['id' => 5, 'name' => 'Jaket Hoodie', 'description' => 'Hoodie hangat untuk cuaca dingin.', 'price' => 180000],
    ['id' => 6, 'name' => 'Tas Ransel', 'description' => 'Tas ransel tahan air, muat laptop 14".', 'price' => 220000],
];

// Halaman Utama
Route::get('/', function () {
    return view('home');
})->name('home');

// Halaman Daftar Produk
Route::get('/products', function () use ($products) {
    return view('products', ['products' => $products]);
})->name('products');

// Tambah produk ke keranjang (session, tanpa login)
Route::post('/cart/add/{id}', function ($id) use ($products) {
    $product = collect($products)->firstWhere('id', (int) $id);
    if (!$product) {
        abort(404);
    }

    $cart = session('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['qty']++;
    } else {
        $cart[$id] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'qty' => 1,
        ];
    }

    session(['cart' => $cart]);

    return redirect()->route('products')->with('success', $product['name'] . ' ditambahkan ke keranjang.');
})->name('cart.add');

// Hapus produk dari keranjang
Route::post('/cart/remove/{id}', function ($id) {
    $cart = session('cart', []);
    unset($cart[$id]);
    session(['cart' => $cart]);

    return redirect()->route('cart');
})->name('cart.remove');

// Halaman Keranjang
Route::get('/cart', function () {
    return view('cart', ['cartItems' => session('cart', [])]);
})->name('cart');

<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar produk beserta kategorinya dengan pagination.
     */
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(10); // batasi 10 data per halaman

        return view('products.index', compact('products'));
    }
}

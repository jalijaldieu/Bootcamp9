<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Tampilkan halaman utama (landing page toko).
     */
    public function home()
    {
        $featured = Product::latest()->take(4)->get();

        return view('home', compact('featured'));
    }

    /**
     * Tampilkan semua produk.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($search = $request->get('q')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $products = $query->orderBy('name')->paginate(9)->withQueryString();

        return view('products.index', compact('products'));
    }

    /**
     * Tampilkan detail satu produk.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductCategoryController extends Controller
{
    /**
     * Tampilkan halaman form tambah kategori produk.
     */
    public function create(): View
    {
        return view('product-categories.create');
    }

    /**
     * Validasi input lalu simpan kategori produk baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Nama kategori sudah ada, gunakan nama lain.',
        ]);

        Category::create($validated);

        return redirect()
            ->route('product-category.create')
            ->with('success', 'Kategori produk berhasil ditambahkan.');
    }
}

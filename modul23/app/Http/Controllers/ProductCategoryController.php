<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductCategoryController extends Controller
{
    /**
     * Tampilkan daftar semua kategori produk.
     */
    public function index(): View
    {
        $categories = Category::withCount('products')->orderBy('name')->paginate(10);

        return view('product-categories.index', [
            'categories' => $categories,
        ]);
    }

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
        $validated = $this->validateCategory($request);

        Category::create($validated);

        return redirect()
            ->route('product-category.index')
            ->with('success', 'Kategori produk berhasil ditambahkan.');
    }

    /**
     * Tampilkan halaman form edit kategori produk, data lama sudah terisi otomatis.
     */
    public function edit(Category $product_category): View
    {
        return view('product-categories.edit', [
            'category' => $product_category,
        ]);
    }

    /**
     * Validasi input perubahan lalu simpan ke database berdasarkan id kategori.
     */
    public function update(Request $request, Category $product_category): RedirectResponse
    {
        $validated = $this->validateCategory($request, $product_category->id);

        $product_category->update($validated);

        return redirect()
            ->route('product-category.index')
            ->with('success', 'Kategori produk berhasil diperbarui.');
    }

    /**
     * Hapus kategori produk dari database berdasarkan id.
     * Kategori yang masih punya produk tidak boleh dihapus, untuk menjaga data tetap konsisten.
     */
    public function destroy(Category $product_category): RedirectResponse
    {
        if ($product_category->products()->exists()) {
            return redirect()
                ->route('product-category.index')
                ->with('error', 'Kategori tidak bisa dihapus karena masih memiliki produk.');
        }

        $product_category->delete();

        return redirect()
            ->route('product-category.index')
            ->with('success', 'Kategori produk berhasil dihapus.');
    }

    /**
     * Aturan validasi input kategori, dipakai bersama oleh store() dan update().
     * $ignoreId dipakai supaya saat edit, nama kategori boleh tetap sama dengan miliknya sendiri.
     */
    protected function validateCategory(Request $request, ?int $ignoreId = null): array
    {
        $uniqueRule = 'unique:categories,name';
        if ($ignoreId) {
            $uniqueRule .= ',' . $ignoreId;
        }

        return $request->validate([
            'name' => ['required', 'string', 'max:255', $uniqueRule],
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Nama kategori sudah ada, gunakan nama lain.',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar semua produk beserta kategorinya.
     */
    public function index(): View
    {
        $products = Product::with('category')->orderBy('name')->paginate(10);

        return view('products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Tampilkan halaman form tambah produk, lengkap dengan daftar kategori
     * untuk dropdown pemilihan kategori produk.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('products.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Validasi input lalu simpan produk baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProduct($request);

        // clicks otomatis default 0 dari migration, tidak perlu diisi manual
        Product::create($validated);

        return redirect()
            ->route('product.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Tampilkan halaman form edit produk, data lama sudah terisi otomatis.
     */
    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();

        return view('products.edit', [
            'product'    => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Validasi input perubahan lalu simpan ke database berdasarkan id produk.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $this->validateProduct($request);

        $product->update($validated);

        return redirect()
            ->route('product.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Hapus produk dari database berdasarkan id.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()
            ->route('product.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Aturan validasi input produk, dipakai bersama oleh store() dan update().
     */
    protected function validateProduct(Request $request): array
    {
        return $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
        ], [
            'name.required'        => 'Nama produk wajib diisi.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak valid.',
            'price.required'       => 'Harga produk wajib diisi.',
            'price.numeric'        => 'Harga harus berupa angka.',
            'price.min'            => 'Harga tidak boleh kurang dari 0.',
        ]);
    }
}

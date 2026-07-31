<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Tampilkan semua produk
    public function index()
    {
        $produks = Produk::latest()->paginate(10);
        return view('produk.index', compact('produks'));
    }

    // Form tambah produk
    public function create()
    {
        return view('produk.create');
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga'     => 'required|numeric|min:0',
            'stok'      => 'required|integer|min:0',
        ]);

        Produk::create($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Detail produk
    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }

    // Form edit produk
    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    // Update produk
    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga'     => 'required|numeric|min:0',
            'stok'      => 'required|integer|min:0',
        ]);

        $produk->update($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // Hapus produk
    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}

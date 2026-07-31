<?php

namespace App\Http\Controllers;

use App\Models\Halaman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HalamanController extends Controller
{
    // Tampilkan semua halaman
    public function index()
    {
        $halamans = Halaman::latest()->paginate(10);
        return view('halaman.index', compact('halamans'));
    }

    // Form tambah halaman
    public function create()
    {
        return view('halaman.create');
    }

    // Simpan halaman baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'  => 'required|string|max:255',
            'konten' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['judul']) . '-' . uniqid();

        Halaman::create($validated);

        return redirect()->route('halaman.index')->with('success', 'Halaman berhasil ditambahkan.');
    }

    // Tampilkan halaman berdasarkan slug (untuk publik)
    public function show(Halaman $halaman)
    {
        return view('halaman.show', compact('halaman'));
    }

    // Form edit halaman
    public function edit(Halaman $halaman)
    {
        return view('halaman.edit', compact('halaman'));
    }

    // Update halaman
    public function update(Request $request, Halaman $halaman)
    {
        $validated = $request->validate([
            'judul'  => 'required|string|max:255',
            'konten' => 'nullable|string',
        ]);

        $halaman->update($validated);

        return redirect()->route('halaman.index')->with('success', 'Halaman berhasil diperbarui.');
    }

    // Hapus halaman
    public function destroy(Halaman $halaman)
    {
        $halaman->delete();

        return redirect()->route('halaman.index')->with('success', 'Halaman berhasil dihapus.');
    }
}

@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <h3>Edit Produk</h3>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="mt-3" style="max-width: 600px;">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                        {{ $category->nama }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama" value="{{ old('nama', $product->nama) }}"
                   class="form-control @error('nama') is-invalid @enderror">
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $product->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" min="0" value="{{ old('stok', $product->stok) }}"
                       class="form-control @error('stok') is-invalid @enderror">
                @error('stok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" min="0" step="0.01" value="{{ old('harga', $product->harga) }}"
                       class="form-control @error('harga') is-invalid @enderror">
                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar</label>
            @if ($product->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}"
                         style="width: 100px; height: 100px; object-fit: cover;" class="rounded">
                </div>
            @endif
            <input type="file" name="gambar" accept="image/*" class="form-control @error('gambar') is-invalid @enderror">
            <div class="form-text">Kosongkan jika tidak ingin mengganti gambar.</div>
            @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection

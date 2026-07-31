@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
    <h3>Detail Produk</h3>

    <div class="bg-white p-4 rounded shadow-sm">
        <p><strong>Nama:</strong> {{ $produk->nama }}</p>
        <p><strong>Deskripsi:</strong> {{ $produk->deskripsi }}</p>
        <p><strong>Harga:</strong> Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
        <p><strong>Stok:</strong> {{ $produk->stok }}</p>

        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection

@extends('layouts.app')

@section('title', $product->name . ' - TokoSederhana')

@section('content')
    <a href="{{ route('products.index') }}" class="text-sm text-indigo-600 hover:underline mb-4 inline-block">&larr; Kembali ke daftar produk</a>

    <div class="bg-white rounded-2xl shadow p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="h-64 md:h-full bg-gray-100 rounded-xl flex items-center justify-center text-7xl">📦</div>

        <div class="flex flex-col">
            <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>
            <p class="text-gray-600 mb-4">{{ $product->description }}</p>
            <p class="text-3xl font-bold text-indigo-600 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="text-sm text-gray-400 mb-6">Stok tersedia: {{ $product->stock }}</p>

            <form action="{{ route('cart.add', $product) }}" method="POST" class="flex items-center gap-3">
                @csrf
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                       class="w-20 border rounded-lg px-3 py-2 text-center">
                <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700">
                    Tambah ke Keranjang
                </button>
            </form>
        </div>
    </div>
@endsection

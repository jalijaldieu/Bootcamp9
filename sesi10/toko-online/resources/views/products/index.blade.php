@extends('layouts.app')

@section('title', 'Produk - TokoSederhana')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <h1 class="text-2xl font-bold">Semua Produk</h1>
        <form method="GET" action="{{ route('products.index') }}" class="flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
                   class="border rounded-lg px-3 py-2 text-sm w-56 focus:outline-none focus:ring-2 focus:ring-indigo-400">
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">Cari</button>
        </form>
    </div>

    @if($products->isEmpty())
        <p class="text-gray-500">Produk tidak ditemukan.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
            @foreach($products as $product)
                <div class="bg-white rounded-xl shadow hover:shadow-md transition p-4 flex flex-col">
                    <a href="{{ route('products.show', $product) }}" class="h-36 bg-gray-100 rounded-lg mb-3 flex items-center justify-center text-5xl">📦</a>
                    <a href="{{ route('products.show', $product) }}" class="font-semibold mb-1 hover:text-indigo-600">{{ $product->name }}</a>
                    <p class="text-gray-500 text-sm mb-2 line-clamp-2">{{ $product->description }}</p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-indigo-600 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <span class="text-xs text-gray-400">Stok: {{ $product->stock }}</span>
                    </div>
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button class="w-full bg-indigo-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">
                            + Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <div>{{ $products->links() }}</div>
    @endif
@endsection

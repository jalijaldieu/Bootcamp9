@extends('layouts.app')

@section('title', 'Beranda - TokoSederhana')

@section('content')
    <section class="bg-indigo-600 rounded-2xl text-white px-8 py-16 text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold mb-3">Belanja Mudah, Cepat, dan Sederhana</h1>
        <p class="text-indigo-100 mb-6 max-w-xl mx-auto">Temukan berbagai produk pilihan dengan harga terbaik. Tidak perlu daftar akun, langsung belanja!</p>
        <a href="{{ route('products.index') }}" class="inline-block bg-white text-indigo-600 font-semibold px-6 py-3 rounded-lg hover:bg-indigo-50">
            Lihat Semua Produk
        </a>
    </section>

    <h2 class="text-xl font-bold mb-4">Produk Terbaru</h2>

    @if($featured->isEmpty())
        <p class="text-gray-500">Belum ada produk. Jalankan <code class="bg-gray-100 px-1 rounded">php artisan db:seed</code> untuk data contoh.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($featured as $product)
                <a href="{{ route('products.show', $product) }}" class="bg-white rounded-xl shadow hover:shadow-md transition p-4 flex flex-col">
                    <div class="h-32 bg-gray-100 rounded-lg mb-3 flex items-center justify-center text-4xl">📦</div>
                    <h3 class="font-semibold text-sm mb-1 line-clamp-2">{{ $product->name }}</h3>
                    <p class="text-indigo-600 font-bold mt-auto">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </a>
            @endforeach
        </div>
    @endif
@endsection

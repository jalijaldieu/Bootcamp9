@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <h1 class="mb-4">Daftar Produk</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($products as $product)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product['name'] }}</h5>
                        <p class="card-text text-muted">{{ $product['description'] }}</p>
                        <p class="fw-bold fs-5">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>

                        <form action="{{ route('cart.add', $product['id']) }}" method="POST" class="mt-auto">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">Tambah ke Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

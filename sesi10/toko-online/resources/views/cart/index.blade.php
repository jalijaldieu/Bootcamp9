@extends('layouts.app')

@section('title', 'Keranjang Belanja - TokoSederhana')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>

    @if(empty($items))
        <div class="bg-white rounded-xl shadow p-10 text-center">
            <p class="text-gray-500 mb-4">Keranjang Anda masih kosong.</p>
            <a href="{{ route('products.index') }}" class="text-indigo-600 font-medium hover:underline">Mulai belanja &rarr;</a>
        </div>
    @else
        <div class="bg-white rounded-xl shadow divide-y">
            @foreach($items as $item)
                <div class="p-4 flex items-center gap-4">
                    <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-2xl shrink-0">📦</div>

                    <div class="flex-1 min-w-0">
                        <a href="{{ route('products.show', $item['product']) }}" class="font-semibold hover:text-indigo-600 block truncate">
                            {{ $item['product']->name }}
                        </a>
                        <p class="text-sm text-gray-500">Rp {{ number_format($item['product']->price, 0, ',', '.') }} / item</p>
                    </div>

                    <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                               class="w-16 border rounded-lg px-2 py-1 text-center text-sm">
                        <button class="text-xs text-indigo-600 hover:underline">Perbarui</button>
                    </form>

                    <div class="w-28 text-right font-semibold">
                        Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                    </div>

                    <form action="{{ route('cart.remove', $item['product']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="bg-white rounded-xl shadow p-6 mt-6 flex items-center justify-between">
            <span class="text-lg font-semibold">Total</span>
            <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('products.index') }}" class="text-indigo-600 hover:underline">&larr; Lanjut belanja</a>
            <a href="{{ route('checkout.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-indigo-700">
                Lanjut ke Checkout
            </a>
        </div>
    @endif
@endsection

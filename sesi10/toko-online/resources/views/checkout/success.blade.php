@extends('layouts.app')

@section('title', 'Pesanan Berhasil - TokoSederhana')

@section('content')
    <div class="bg-white rounded-2xl shadow p-10 text-center max-w-xl mx-auto">
        <div class="text-5xl mb-4">✅</div>
        <h1 class="text-2xl font-bold mb-2">Pesanan Berhasil Dibuat!</h1>
        <p class="text-gray-500 mb-6">Nomor pesanan Anda: <span class="font-semibold text-gray-800">#{{ $order->id }}</span></p>

        <div class="text-left bg-gray-50 rounded-xl p-4 mb-6 space-y-2">
            @foreach($order->items as $item)
                <div class="flex justify-between text-sm">
                    <span>{{ $item->product_name }} &times; {{ $item->quantity }}</span>
                    <span class="font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
            @endforeach
            <div class="border-t pt-2 flex justify-between font-semibold">
                <span>Total</span>
                <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-indigo-700">
            Lanjut Belanja
        </a>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Checkout - TokoSederhana')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2 bg-white rounded-xl shadow p-6">
            <h2 class="font-semibold mb-4">Data Pengiriman</h2>

            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-100 border border-red-300 text-red-800 px-4 py-3 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name') }}"
                           class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                           class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Nomor Telepon</label>
                    <input type="text" name="customer_phone" value="{{ old('customer_phone') }}"
                           class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Alamat Pengiriman</label>
                    <textarea name="customer_address" rows="3"
                              class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>{{ old('customer_address') }}</textarea>
                </div>

                <button class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700">
                    Buat Pesanan
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow p-6 h-fit">
            <h2 class="font-semibold mb-4">Ringkasan Pesanan</h2>
            <div class="space-y-3 mb-4">
                @foreach($items as $item)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">{{ $item['product']->name }} &times; {{ $item['quantity'] }}</span>
                        <span class="font-medium">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
            <div class="border-t pt-4 flex justify-between items-center">
                <span class="font-semibold">Total</span>
                <span class="text-xl font-bold text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
@endsection

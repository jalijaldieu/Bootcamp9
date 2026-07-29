<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Online Sederhana')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    <header class="bg-indigo-600 text-white shadow">
        <nav class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight">🛍️ TokoSederhana</a>
            <div class="flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('home') }}" class="hover:text-indigo-200">Beranda</a>
                <a href="{{ route('products.index') }}" class="hover:text-indigo-200">Produk</a>
                <a href="{{ route('cart.index') }}" class="hover:text-indigo-200 relative">
                    Keranjang
                    @php $cartCount = collect(session('cart', []))->sum(); @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-4 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>
        </nav>
    </header>

    <main class="flex-1 max-w-6xl mx-auto w-full px-4 py-8">
        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-lg bg-red-100 border border-red-300 text-red-800 px-4 py-3 text-sm">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white border-t mt-10">
        <div class="max-w-6xl mx-auto px-4 py-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} TokoSederhana. Proyek belajar Laravel — tanpa login/logout.
        </div>
    </footer>

</body>
</html>

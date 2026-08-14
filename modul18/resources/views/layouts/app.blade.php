<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Manajemen Produk')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-indigo-600 text-white">
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
            <span class="font-semibold text-lg">Manajemen Produk</span>
            <div class="space-x-4">
                <a href="{{ route('products.index') }}" class="hover:underline">Produk</a>
                <a href="{{ route('categories.index') }}" class="hover:underline">Kategori</a>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-8">
        @if (session('success'))
            <div class="mb-4 rounded-md bg-green-100 border border-green-300 text-green-800 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>

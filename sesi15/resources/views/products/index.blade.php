<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Daftar Produk</h1>

        <table class="w-full bg-white shadow rounded overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Nama Produk</th>
                    <th class="p-3 text-left">Kategori</th>
                    <th class="p-3 text-left">Harga</th>
                    <th class="p-3 text-left">Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $index => $product)
                    <tr class="border-b">
                        <td class="p-3">{{ $products->firstItem() + $index }}</td>
                        <td class="p-3">{{ $product->name }}</td>
                        <td class="p-3">{{ $product->category->name ?? '-' }}</td>
                        <td class="p-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="p-3">{{ $product->stock }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 text-center">Belum ada data produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>

</body>
</html>

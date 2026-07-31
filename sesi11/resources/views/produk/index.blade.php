@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Kelola Produk</h3>
        <a href="{{ route('produk.create') }}" class="btn btn-primary">+ Tambah Produk</a>
    </div>

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th style="width: 180px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produks as $produk)
                <tr>
                    <td>{{ $produk->nama }}</td>
                    <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                    <td>{{ $produk->stok }}</td>
                    <td>
                        <a href="{{ route('produk.edit', $produk) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('produk.destroy', $produk) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $produks->links() }}
@endsection

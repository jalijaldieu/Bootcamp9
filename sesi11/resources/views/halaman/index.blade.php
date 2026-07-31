@extends('layouts.app')

@section('title', 'Kelola Halaman')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Kelola Halaman</h3>
        <a href="{{ route('halaman.create') }}" class="btn btn-primary">+ Tambah Halaman</a>
    </div>

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Slug</th>
                <th style="width: 180px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($halamans as $halaman)
                <tr>
                    <td>{{ $halaman->judul }}</td>
                    <td>{{ $halaman->slug }}</td>
                    <td>
                        <a href="{{ route('halaman.show', $halaman) }}" class="btn btn-sm btn-info">Lihat</a>
                        <a href="{{ route('halaman.edit', $halaman) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('halaman.destroy', $halaman) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin hapus halaman ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada halaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $halamans->links() }}
@endsection

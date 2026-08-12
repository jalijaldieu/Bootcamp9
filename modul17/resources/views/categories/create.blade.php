@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <h3>Tambah Kategori</h3>

    <form action="{{ route('categories.store') }}" method="POST" class="mt-3" style="max-width: 500px;">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="nama" value="{{ old('nama') }}"
                   class="form-control @error('nama') is-invalid @enderror">
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection

@extends('layouts.app')

@section('title', 'Tambah Halaman')

@section('content')
    <h3>Tambah Halaman</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('halaman.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Judul Halaman</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konten</label>
            <textarea name="konten" class="form-control" rows="6">{{ old('konten') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('halaman.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection

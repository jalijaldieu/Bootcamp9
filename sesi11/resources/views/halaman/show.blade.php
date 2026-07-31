@extends('layouts.app')

@section('title', $halaman->judul)

@section('content')
    <div class="bg-white p-4 rounded shadow-sm">
        <h3>{{ $halaman->judul }}</h3>
        <p class="text-muted">Slug: {{ $halaman->slug }}</p>
        <hr>
        <div>{!! nl2br(e($halaman->konten)) !!}</div>

        <a href="{{ route('halaman.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection

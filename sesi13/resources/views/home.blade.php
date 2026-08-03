@extends('layouts.app')

@section('title', 'Halaman Utama')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3 text-center">
        <h1 class="display-5 fw-bold">Selamat Datang di TokoSederhana</h1>
        <p class="col-lg-8 mx-auto fs-5">
            Contoh aplikasi Laravel sederhana yang dibangun menggunakan Blade:
            halaman utama, daftar produk, dan keranjang — lengkap dengan komponen
            Navbar dan Footer yang dipakai ulang di setiap halaman. Tanpa login/logout.
        </p>
        <a href="{{ route('products') }}" class="btn btn-primary btn-lg mt-2">Lihat Produk</a>
    </div>

    <div class="row text-center">
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">📄 Halaman Berbasis Blade</h5>
                    <p class="card-text">Setiap halaman dibuat menggunakan file <code>.blade.php</code> yang mewarisi satu layout utama.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">🧩 Komponen Reusable</h5>
                    <p class="card-text">Navbar dan Footer dibuat sebagai komponen Blade (<code>&lt;x-navbar /&gt;</code>, <code>&lt;x-footer /&gt;</code>).</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">🛒 Keranjang Sederhana</h5>
                    <p class="card-text">Tambah produk ke keranjang menggunakan session, tanpa perlu login.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

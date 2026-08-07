<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">🛍️ TokoSederhana</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">Halaman Utama</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products') ? 'active fw-bold' : '' }}" href="{{ route('products') }}">Daftar Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cart') ? 'active fw-bold' : '' }}" href="{{ route('cart') }}">
                        Keranjang
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="badge bg-warning text-dark">{{ count(session('cart')) }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

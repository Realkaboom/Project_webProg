<aside id="userSidebar" class="collapse d-md-block p-3 sidebar">
    <div class="d-flex align-items-center mb-3 text-white">
        <span class="me-2 fw-bold fs-4 lh-1">≡</span>
        <span class="fw-semibold">Menu</span>
    </div>
    <nav class="flex-column gap-1 nav">
        <a class="nav-link {{ request()->routeIs('viewall') ? 'active' : '' }}" href="{{ route('viewall') }}">Dashboard</a>
        <a class="nav-link {{ request()->routeIs('user.barang') ? 'active' : '' }}" href="{{ route('user.barang') }}">Barang</a>
        <a class="nav-link {{ request()->routeIs('requests.my') ? 'active' : '' }}" href="{{ route('requests.my') }}">Riwayat permintaan</a>
    </nav>
</aside>

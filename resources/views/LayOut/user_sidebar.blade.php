<aside id="userSidebar" class="sidebar p-3 collapse d-md-block">
    <div class="d-flex align-items-center mb-3 text-white">
        <span class="fw-bold fs-4 lh-1 me-2">≡</span>
        <span class="fw-semibold">Menu</span>
    </div>
    <nav class="nav flex-column gap-1">
        <a class="nav-link {{ request()->routeIs('viewall') ? 'active' : '' }}" href="{{ route('viewall') }}">Dashboard</a>
        <a class="nav-link {{ request()->routeIs('user.barang') ? 'active' : '' }}" href="{{ route('user.barang') }}">Barang</a>
        <a class="nav-link {{ request()->routeIs('requests.my') ? 'active' : '' }}" href="{{ route('requests.my') }}">Riwayat permintaan</a>
    </nav>
</aside>

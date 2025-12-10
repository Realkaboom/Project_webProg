<aside id="adminSidebar" class="sidebar p-3 collapse show d-md-block">
    <div class="d-flex align-items-center mb-4 text-white">
        <div class="fw-bold fs-4 lh-1 me-2">≡</div>
        <span class="fw-semibold">Menu</span>
    </div>
    <nav class="nav flex-column gap-1">
        <a class="nav-link {{ request()->routeIs('viewadmin') ? 'active' : '' }}" href="{{ route('viewadmin') }}">Dashboard</a>
        <a class="nav-link {{ request()->routeIs('viewbarang') ? 'active' : '' }}" href="{{ route('viewbarang') }}">Barang</a>
        @if (Route::has('requests.index'))
            <a class="nav-link {{ request()->routeIs('requests.index') ? 'active' : '' }}" href="{{ route('requests.index') }}">Permintaan</a>
        @endif
    </nav>
</aside>

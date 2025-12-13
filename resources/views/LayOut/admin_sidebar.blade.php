<aside id="adminSidebar" class="collapse d-md-block p-3 sidebar show">
    <div class="d-flex align-items-center mb-4 text-white">
        <div class="me-2 fw-bold fs-4 lh-1">≡</div>
        <span class="fw-semibold">Menu</span>
    </div>
    <nav class="flex-column gap-1 nav">
        <a class="nav-link {{ request()->routeIs('viewadmin') ? 'active' : '' }}" href="{{ route('viewadmin') }}">Dashboard</a>
        <a class="nav-link {{ request()->routeIs('viewbarang') ? 'active' : '' }}" href="{{ route('viewbarang') }}">Barang</a>
        @if (Route::has('requests.index'))
            <a class="nav-link {{ request()->routeIs('requests.index') ? 'active' : '' }}" href="{{ route('requests.index') }}">Permintaan</a>
        @endif
    </nav>
</aside>

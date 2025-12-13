<nav class="top-0 z-3 position-sticky bg-white shadow-sm py-3 w-100 navbar navbar-expand-lg">
    <div class="px-4 container-fluid">
        <a class="text-dark navbar-brand fw-bold" href="{{ route('viewadmin') }}">Inventaris Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminSidebar" aria-controls="adminSidebar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex align-items-center gap-3 ms-auto">
            <div class="text-muted text-end small">
                <div class="text-dark fw-semibold">{{ Auth::user()->nama ?? Auth::user()->name ?? 'Admin' }}</div>
                <div>{{ $subtitle ?? '' }}</div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mb-0">
                @csrf
                <button class="btn-outline-secondary btn btn-sm">Log Out</button>
            </form>
        </div>
    </div>
</nav>

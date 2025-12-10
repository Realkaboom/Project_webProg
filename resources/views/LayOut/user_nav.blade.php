<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3 top-nav">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold text-dark" href="{{ route('viewall') }}">Inventaris</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userSidebar" aria-controls="userSidebar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex align-items-center gap-3 ms-auto flex-wrap justify-content-end">
            <div class="text-end small text-muted">
                <div class="fw-semibold text-dark">{{ Auth::user()->nama ?? Auth::user()->name ?? 'User' }}</div>
                <div>{{ $subtitle ?? '' }}</div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mb-0">
                @csrf
                <button class="btn btn-outline-secondary btn-sm">Log Out</button>
            </form>
        </div>
    </div>
</nav>

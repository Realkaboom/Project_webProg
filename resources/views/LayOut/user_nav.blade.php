<nav class="top-nav bg-white shadow-sm py-3 navbar navbar-expand-lg">
    <div class="px-4 container-fluid">
        <a class="text-dark navbar-brand fw-bold" href="{{ route('viewall') }}">Inventaris</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userSidebar" aria-controls="userSidebar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-3 ms-auto">
            <div class="text-muted text-end small">
                <div class="text-dark fw-semibold">{{ Auth::user()->nama ?? Auth::user()->name ?? 'User' }}</div>
                <div>{{ $subtitle ?? '' }}</div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mb-0">
                @csrf
                <button class="btn-outline-secondary btn btn-sm">Log Out</button>
            </form>
        </div>
    </div>
</nav>

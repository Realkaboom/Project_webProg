<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Permintaan Barang | Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root { --primary: #0d1b3d; }
        body { background: #eef1f5; font-family: 'Figtree', sans-serif; }
        .app-shell { min-height: 100vh; }
        .sidebar { width: 220px; min-height: 100vh; background: var(--primary); color: #cfd6e4; position: sticky; top: 0; box-shadow: 8px 0 24px rgba(0,0,0,0.08); }
        .sidebar .nav-link { color: #cfd6e4; border-radius: 10px; padding: 0.65rem 0.85rem; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,0.12); color: #fff; }
        .card { border: none; border-radius: 18px; box-shadow: 0 20px 50px rgba(0,0,0,0.08); }
        .table thead th { background: #f8f9fd; }
        .status-badge { border-radius: 999px; padding: 4px 10px; font-size: 0.85rem; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold text-dark" href="{{ route('viewadmin') }}">Inventaris Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav" aria-controls="topNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4"></ul>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end small text-muted">
                    <div class="fw-semibold text-dark">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div>Permintaan</div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mb-0">
                    @csrf
                    <button class="btn btn-outline-secondary btn-sm">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>
<div class="d-flex app-shell">
    <aside class="sidebar p-3 d-none d-md-block">
        <div class="d-flex align-items-center mb-4 text-white">
            <div class="fw-bold fs-4 lh-1 me-2">≡</div>
            <span class="fw-semibold">Menu</span>
        </div>
        <nav class="nav flex-column gap-1">
            <a class="nav-link" href="{{ route('viewadmin') }}">Dashboard</a>
            <a class="nav-link" href="{{ route('viewbarang') }}">Barang</a>
            <a class="nav-link active" href="{{ route('requests.index') }}">Permintaan</a>
        </nav>
    </aside>
    <main class="flex-grow-1 p-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-3">
            <div>
                <h4 class="fw-bold mb-1">Permintaan Barang</h4>
                <p class="text-muted mb-0">Review, approve, atau reject permintaan yang masuk.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="fw-bold mb-1">Daftar Permintaan</h6>
                        <p class="text-muted mb-0">{{ count($requests) }} permintaan tercatat.</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>User</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $req)
                                <tr>
                                    <td class="fw-semibold">{{ $req->id }}</td>
                                    <td>
                                        <div class="fw-semibold">{{ $req->barang->namabarang ?? '-' }}</div>
                                        <small class="text-muted">Stok: {{ $req->barang->jumlahbarang ?? 0 }}</small>
                                    </td>
                                    <td>{{ $req->quantity }}</td>
                                    <td>{{ $req->user->nama ?? '-' }}</td>
                                    <td>
                                        @php
                                            $status = strtolower($req->status);
                                            $badgeClass = match($status) {
                                                'approved' => 'text-bg-success',
                                                'rejected' => 'text-bg-danger',
                                                default => 'text-bg-warning text-dark',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }} status-badge">{{ ucfirst($req->status) }}</span>
                                    </td>
                                    <td class="text-end">
                                        @if($req->status === 'pending')
                                            <div class="btn-group">
                                                <form action="{{ route('requests.approve', $req->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm" type="submit">Approve</button>
                                                </form>
                                                <form action="{{ route('requests.reject', $req->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" type="submit">Reject</button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-muted">Sudah diproses</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Belum ada permintaan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

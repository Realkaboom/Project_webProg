<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Supplier | Inventaris</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root { --primary: #0d1b3d; }
        body { background: #eef1f5; font-family: 'Figtree', sans-serif; }
        .app-shell { min-height: 100vh; }
        .sidebar {
            width: 220px; min-height: 100vh; background: var(--primary); color: #cfd6e4;
            position: sticky; top: 0; box-shadow: 8px 0 24px rgba(0,0,0,0.08);
        }
        .sidebar .nav-link { color: #cfd6e4; border-radius: 10px; padding: 0.65rem 0.85rem; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,0.12); color: #fff; }
        .card { border: none; border-radius: 18px; box-shadow: 0 20px 50px rgba(0,0,0,0.08); }
        .form-label { font-weight: 600; color: #1d2433; }
    </style>
</head>
<body>
<nav class="bg-white shadow-sm py-3 navbar navbar-expand-lg">
    <div class="px-4 container-fluid">
        <a class="text-dark navbar-brand fw-bold" href="{{ route('viewadmin') }}">Inventaris Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav" aria-controls="topNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNav">
            <ul class="ms-lg-4 me-auto mb-2 mb-lg-0 navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('viewadmin') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('viewbarang') }}">Barang</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('suppliers.create') }}">Supplier</a></li>
                @if (Route::has('requests.index'))
                    <li class="nav-item"><a class="nav-link" href="{{ route('requests.index') }}">Permintaan</a></li>
                @endif
            </ul>
            <div class="d-flex align-items-center gap-3">
                <div class="text-muted text-end small">
                    <div class="text-dark fw-semibold">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div>Supplier</div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mb-0">
                    @csrf
                    <button class="btn-outline-secondary btn btn-sm">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>
<div class="d-flex app-shell">
    <aside class="d-md-block p-3 sidebar d-none">
        <div class="d-flex align-items-center mb-4 text-white">
            <div class="me-2 fw-bold fs-4 lh-1">≡</div>
            <span class="fw-semibold">Menu</span>
        </div>
        <nav class="flex-column gap-1 nav">
            <a class="nav-link" href="{{ route('viewadmin') }}">Dashboard</a>
            <a class="nav-link" href="{{ route('viewbarang') }}">Barang</a>
            <a class="nav-link active" href="{{ route('suppliers.create') }}">Kategori & Supplier</a>
            @if (Route::has('requests.index'))
                <a class="nav-link" href="{{ route('requests.index') }}">Permintaan</a>
            @endif
        </nav>
    </aside>
    <main class="flex-grow-1 p-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between mb-3">
            <div>
                <h4 class="mb-1 fw-bold">Tambah Supplier</h4>
                <p class="mb-0 text-muted">Lengkapi informasi supplier untuk mempermudah pengadaan.</p>
            </div>
            <a href="{{ route('suppliers.index') }}" class="mt-3 mt-lg-0 btn-outline-secondary btn">Kembali ke daftar</a>
        </div>
        <div class="card">
            <div class="p-4 card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('suppliers.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="name">Nama Supplier</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama supplier" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="contact">Kontak</label>
                            <input type="text" id="contact" name="contact" class="form-control" placeholder="Nomor telepon / email" value="{{ old('contact') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="address">Alamat</label>
                            <textarea id="address" name="address" class="form-control" rows="3" placeholder="Alamat lengkap">{{ old('address') }}</textarea>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('suppliers.index') }}" class="btn-outline-secondary btn">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

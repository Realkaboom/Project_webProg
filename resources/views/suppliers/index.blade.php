<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supplier | Inventaris</title>
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
        .form-label { font-weight: 600; color: #1d2433; }
        .table thead th { background: #f8f9fd; }
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
                    <div>Supplier</div>
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
            @if (Route::has('requests.index'))
                <a class="nav-link" href="{{ route('requests.index') }}">Permintaan</a>
            @endif
        </nav>
    </aside>
    <main class="flex-grow-1 p-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-3">
            <div>
                <h4 class="fw-bold mb-1">Supplier</h4>
                <p class="text-muted mb-0">Kelola daftar supplier dan tambah data baru.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="fw-bold mb-1">Daftar Supplier</h6>
                                <p class="text-muted mb-0">{{ count($suppliers) }} supplier terdaftar.</p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Kontak</th>
                                        <th>Alamat</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($suppliers as $sup)
                                        <tr>
                                            <td class="fw-semibold">{{ $sup->id }}</td>
                                            <td>{{ $sup->name }}</td>
                                            <td>{{ $sup->contact }}</td>
                                            <td>{{ $sup->address }}</td>
                                            <td class="text-end">
                                                <div class="btn-group">
                                                    <a href="{{ route('suppliers.edit', $sup->id) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                                    <form action="{{ route('suppliers.destroy', $sup->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">Belum ada supplier.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Tambah Supplier</h6>
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
                            <div class="mb-3">
                                <label class="form-label" for="name">Nama Supplier</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama supplier" value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="contact">Kontak</label>
                                <input type="text" id="contact" name="contact" class="form-control" placeholder="Nomor telepon / email" value="{{ old('contact') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="address">Alamat</label>
                                <textarea id="address" name="address" class="form-control" rows="3" placeholder="Alamat lengkap">{{ old('address') }}</textarea>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary">Bersihkan</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Barang | Inventaris</title>
    <link rel="stylesheet" href="{{ asset('css/add.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root {
            --primary: #0d1b3d;
            --accent: #f4b400;
        }
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
        .table thead th { background: #f8f9fd; }
        .thumb { width: 60px; height: 60px; object-fit: cover; border-radius: 10px; border: 1px solid #e6e9ef; }
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
                    <div>Barang</div>
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
            <a class="nav-link active" href="{{ route('viewbarang') }}">Barang</a>
            @if (Route::has('requests.index'))
                <a class="nav-link" href="{{ route('requests.index') }}">Permintaan</a>
            @endif
        </nav>
    </aside>
    <main class="flex-grow-1 p-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-3">
            <div>
                <h4 class="fw-bold mb-1">Barang</h4>
                <p class="text-muted mb-0">Lihat semua barang dan tambah dari halaman ini.</p>
            </div>
            <a class="btn btn-primary mt-3 mt-lg-0" data-bs-toggle="collapse" href="#addBarang" role="button" aria-expanded="true" aria-controls="addBarang">Tambah Barang</a>
        </div>

        <div class="collapse show" id="addBarang">
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Form Tambah Barang</h6>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Kategori</label>
                                <div class="d-flex gap-2">
                                    <select class="form-control" name="kategoribarang" required>
                                        <option value="">-- pilih kategori --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    <a class="btn btn-outline-primary" href="{{ route('categories.create') }}">+</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Supplier</label>
                                <div class="d-flex gap-2">
                                    <select class="form-control" name="supplierbarang" required>
                                        <option value="">-- pilih supplier --</option>
                                        @foreach($suppliers as $sup)
                                            <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                        @endforeach
                                    </select>
                                    <a class="btn btn-outline-primary" href="{{ route('suppliers.create') }}">+</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama barang</label>
                                <input type="text" class="form-control" name="namabarang" placeholder="Nama" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" class="form-control" name="hargabarang" min="0" placeholder="0" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" class="form-control" name="jumlahbarang" min="0" placeholder="0" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Foto barang</label>
                                <input type="file" class="form-control" name="fotobarang" accept="image/*">
                            </div>
                        </div>
                        <div class="mt-3 d-flex gap-2">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#addBarang">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="fw-bold mb-1">Semua Barang</h6>
                        <p class="text-muted mb-0">Daftar lengkap barang yang sudah dibuat.</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Barang</th>
                                <th>Kategori</th>
                                <th>Supplier</th>
                                <th class="text-end">Harga</th>
                                <th class="text-center">Stok</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($semuabarang as $item)
                                @php
                                    $img = $item->fotobarang
                                        ? asset('fotobarang/'.$item->fotobarang)
                                        : 'https://via.placeholder.com/120x90?text=No+Image';
                                @endphp
                                <tr>
                                    <td class="fw-semibold">{{ $item->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $img }}" alt="foto {{ $item->namabarang }}" class="thumb">
                                            <div>
                                                <div class="fw-semibold">{{ $item->namabarang }}</div>
                                                <small class="text-muted">Rp{{ number_format($item->hargabarang, 0, ',', '.') }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->category->name ?? '-' }}</td>
                                    <td>{{ $item->supplier->name ?? '-' }}</td>
                                    <td class="text-end">Rp{{ number_format($item->hargabarang, 0, ',', '.') }}</td>
                                    <td class="text-center fw-semibold">{{ $item->jumlahbarang }} pcs</td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('editform', ['id' => $item->id]) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                            <form method="POST" action="{{ route('delete', ['id' => $item->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">Belum ada barang yang tercatat.</td>
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

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Permintaan | Inventaris</title>
    <link rel="stylesheet" href="{{ asset('css/add.css') }}">
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
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold text-dark" href="{{ route('viewall') }}">Inventaris</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavUser" aria-controls="topNavUser" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavUser">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4"></ul>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end small text-muted">
                    <div class="fw-semibold text-dark">{{ Auth::user()->name ?? 'User' }}</div>
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
            <a class="nav-link" href="{{ route('viewall') }}">Dashboard</a>
            <a class="nav-link" href="{{ route('user.barang') }}">Barang</a>
            <a class="nav-link active" href="{{ route('requests.my') }}">Riwayat permintaan</a>
        </nav>
    </aside>
    <main class="flex-grow-1 p-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-3">
            <div>
                <h4 class="fw-bold mb-1">Buat Permintaan</h4>
                <p class="text-muted mb-0">Pilih barang, isi jumlah, dan berikan catatan jika diperlukan.</p>
            </div>
            <a href="{{ route('requests.my') }}" class="btn btn-outline-secondary mt-3 mt-lg-0">Lihat Riwayat</a>
        </div>

        @if ($errors->any())
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
                <form method="POST" action="{{ route('requests.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Pilih Barang</label>
                        <select name="barang_id" class="form-select" required>
                            <option value="">-- pilih barang --</option>
                            @foreach($barangs as $b)
                                <option value="{{ $b->id }}" @selected(old('barang_id', $selectedBarangId ?? null) == $b->id)>
                                    {{ $b->namabarang }} (Stok: {{ $b->jumlahbarang }}) - Supplier: {{ $b->supplier->name ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="quantity" class="form-control" min="1" value="{{ old('quantity', 1) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan (opsional)</label>
                        <textarea name="note" class="form-control" rows="3" placeholder="Misal: prioritas, keperluan, dsb.">{{ old('note') }}</textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
                        <a href="{{ route('viewall') }}" class="btn btn-outline-secondary">Batal</a>
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

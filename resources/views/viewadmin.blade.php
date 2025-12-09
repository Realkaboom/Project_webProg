<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('css/add.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root {
            --primary: #0d1b3d;
            --accent: #f4b400;
            --muted: #6c7a91;
        }
        body {
            background: #eef1f5;
            font-family: 'Figtree', sans-serif;
        }
        .app-shell {
            min-height: 100vh;
        }
        .sidebar {
            width: 220px;
            min-height: 100vh;
            background: var(--primary);
            color: #cfd6e4;
            position: sticky;
            top: 0;
            box-shadow: 8px 0 24px rgba(0,0,0,0.08);
        }
        .sidebar .nav-link {
            color: #cfd6e4;
            border-radius: 10px;
            padding: 0.65rem 0.85rem;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.12);
            color: #fff;
        }
        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.08);
        }
        .chart-wrapper {
            border: 1px solid #e5e8ef;
            border-radius: 12px;
            padding: 1rem 1.25rem 0.5rem;
        }
        .chart-grid {
            display: flex;
            align-items: flex-end;
            gap: 14px;
            height: 220px;
            position: relative;
        }
        .chart-grid::before {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 1px;
            background: #cfd3dc;
        }
        .chart-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            width: 30px;
        }
        .bar-primary {
            width: 100%;
            border-radius: 10px;
            background: linear-gradient(180deg, #5a74ff, #3348d4);
        }
        .bar-accent {
            width: 100%;
            border-radius: 10px;
            background: linear-gradient(180deg, #ffd960, var(--accent));
        }
        .latest-card {
            border: 1px solid #e8ecf2;
            border-radius: 12px;
        }
        .latest-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #e6e9ef;
        }
        .status-pill {
            padding: 0.2rem 0.65rem;
            border-radius: 999px;
            font-size: 0.78rem;
        }
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
                    <div>Dashboard</div>
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
            <a class="nav-link active" href="#">Dashboard</a>
            <a class="nav-link" href="{{ route('viewbarang') }}">Barang</a>
            @if (Route::has('requests.index'))
                <a class="nav-link" href="{{ route('requests.index') }}">Permintaan</a>
            @endif
        </nav>
    </aside>
    <main class="flex-grow-1 p-4">
        <div class="row g-4 mb-4 align-items-stretch">
            <div class="col-lg-7">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="fw-bold mb-1">Tren Permintaan</h5>
                                <p class="text-muted mb-0">Snapshot 6 bulan terakhir</p>
                            </div>
                            <span class="badge text-bg-light text-uppercase">Draft</span>
                        </div>
                        <div class="chart-wrapper">
                            @php
                                $chart = [48, 62, 55, 70, 59, 68];
                            @endphp
                            <div class="chart-grid">
                                @foreach ($chart as $value)
                                    <div class="chart-col">
                                        <div class="bar-primary" style="height: {{ 70 + $loop->index * 4 }}px;"></div>
                                        <div class="bar-accent" style="height: {{ max(45, $value) }}px;"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="fw-bold mb-1">Barang terbaru</h5>
                                <p class="text-muted mb-0">3 item terakhir masuk</p>
                            </div>
                            <a href="{{ route('viewbarang') }}" class="btn btn-sm btn-primary">Tambah</a>
                        </div>
                        @php
                            $latestItems = collect($semuabarang ?? [])->sortByDesc('id')->take(3);
                        @endphp
                        @forelse ($latestItems as $item)
                            @php
                                $img = $item->fotobarang
                                    ? asset('fotobarang/'.$item->fotobarang)
                                    : 'https://via.placeholder.com/160x120?text=No+Image';
                            @endphp
                            <div class="p-3 mb-3 latest-card">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $img }}" alt="foto {{ $item->namabarang }}" class="latest-img me-3">
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <small class="text-muted">ID: {{ $item->id }}</small>
                                                <h6 class="fw-bold mb-1">{{ $item->namabarang }}</h6>
                                                <div class="text-muted">Kategori: {{ $item->category->name ?? '-' }}</div>
                                                <div class="text-muted">Supplier: {{ $item->supplier->name ?? '-' }}</div>
                                                <div class="fw-semibold">Rp{{ number_format($item->hargabarang, 0, ',', '.') }} • {{ $item->jumlahbarang }} pcs</div>
                                            </div>
                                            <div class="btn-group">
                                                <a href="{{ route('editform', ['id' => $item->id]) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                                <form method="POST" action="{{ route('delete', ['id' => $item->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger btn-sm">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-light border">Belum ada barang yang tercatat.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">Stock Alert</h5>
                        <p class="text-muted mb-0">Pantau barang di bawah ambang aman</p>
                    </div>
                    <span class="badge text-bg-warning text-dark">Auto generated</span>
                </div>
                @php
                    $lowStock = collect($semuabarang ?? [])->filter(fn($item) => ($item->jumlahbarang ?? 0) <= 5)->take(6);
                @endphp
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Ambang</th>
                                <th class="text-end">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lowStock as $alert)
                                <tr>
                                    <td class="fw-semibold">{{ $alert->id }}</td>
                                    <td>{{ $alert->namabarang }}</td>
                                    <td>{{ $alert->category->name ?? '-' }}</td>
                                    <td class="text-center fw-semibold">{{ $alert->jumlahbarang }} pcs</td>
                                    <td class="text-center">≤ 5 pcs</td>
                                    <td class="text-end">
                                        <span class="badge text-bg-danger">Perlu Restock</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Stok aman. Tidak ada peringatan.</td>
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

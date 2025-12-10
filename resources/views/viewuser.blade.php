<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard User</title>
    <link rel="stylesheet" href="{{ asset('css/add.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @include('LayOut.user_styles')
</head>
<body>
@include('LayOut.user_nav', ['subtitle' => 'Dashboard'])
<div class="d-flex app-shell">
    @include('LayOut.user_sidebar')
    <main class="main-content">
        <div class="row g-4 mb-4 align-items-stretch">
            <div class="col-lg-7">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column h-100">
                        @php
                            $items = collect($semuabarang ?? []);
                            $totalBarang = $items->count();
                            $totalStok = $items->sum('jumlahbarang');
                            $lowStockCount = $items->filter(fn($i) => ($i->jumlahbarang ?? 0) <= 5)->count();
                        @endphp
                        <div class="mb-4">
                            <h5 class="fw-bold mb-2">Selamat datang di Inventaris</h5>
                            <p class="text-muted mb-0">Kelola barang, ajukan permintaan, dan pantau stok dengan mudah.</p>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-sm-4">
                                <div class="p-3 border rounded-3 bg-light h-100">
                                    <div class="text-muted small">Total Barang</div>
                                    <div class="fw-bold fs-4">{{ $totalBarang }}</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="p-3 border rounded-3 bg-light h-100">
                                    <div class="text-muted small">Total Stok</div>
                                    <div class="fw-bold fs-4">{{ $totalStok }} pcs</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="p-3 border rounded-3 bg-light h-100">
                                    <div class="text-muted small">Perlu Restock</div>
                                    <div class="fw-bold fs-4">{{ $lowStockCount }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 border rounded-3 bg-light mb-4">
                            <ul class="mb-0 text-muted small">
                                <li>Cek barang terbaru dan ajukan permintaan langsung.</li>
                                <li>Pantau stok menipis di bagian Stock Alert.</li>
                                <li>Riwayat permintaan bisa dilihat di menu samping.</li>
                            </ul>
                        </div>
                        <div class="mt-auto d-flex flex-wrap gap-2">
                            @if (Route::has('user.barang'))
                                <a href="{{ route('user.barang') }}" class="btn btn-primary btn-sm">Lihat semua barang</a>
                            @endif
                            @if (Route::has('requests.create'))
                                <a href="{{ route('requests.create') }}" class="btn btn-outline-secondary btn-sm">Buat permintaan</a>
                            @endif
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
                                <p class="text-muted mb-0">3 item terbaru tersedia</p>
                            </div>
                            @if (Route::has('requests.create'))
                                <a href="{{ route('requests.create') }}" class="btn btn-sm btn-primary">Minta Barang</a>
                            @endif
                        </div>
                        @php $latestItems = collect($semuabarang ?? [])->sortByDesc('id')->take(3); @endphp
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
                                        <small class="text-muted">ID: {{ $item->id }}</small>
                                        <h6 class="fw-bold mb-1">{{ $item->namabarang }}</h6>
                                        <div class="text-muted">Kategori: {{ $item->category->name ?? '-' }}</div>
                                        <div class="text-muted">Supplier: {{ $item->supplier->name ?? '-' }}</div>
                                        <div class="fw-semibold">Rp{{ number_format($item->hargabarang, 0, ',', '.') }} - {{ $item->jumlahbarang }} pcs</div>
                                    </div>
                                    @if (Route::has('requests.create'))
                                        <a href="{{ route('requests.create', ['barang_id' => $item->id]) }}" class="btn btn-outline-primary btn-sm">Ajukan</a>
                                    @endif
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
                        <p class="text-muted mb-0">Daftar stok tipis untuk diprioritaskan</p>
                    </div>
                    <span class="badge text-bg-warning text-dark">Info</span>
                </div>
                @php $lowStock = collect($semuabarang ?? [])->filter(fn($item) => ($item->jumlahbarang ?? 0) <= 5)->take(6); @endphp
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th class="text-center">Qty</th>
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
                                    <td class="text-end">
                                        <span class="badge text-bg-danger">Perlu Restock</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Stok aman. Tidak ada peringatan.</td>
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


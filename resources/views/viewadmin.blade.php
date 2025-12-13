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
    @include('LayOut.admin_styles')
</head>
<body>
@include('LayOut.admin_nav', ['subtitle' => 'Dashboard'])
<div class="d-flex app-shell main-wrapper">
    @include('LayOut.admin_sidebar')
    <main class="main-content">
        <div class="align-items-stretch mb-4 row g-4">
            <div class="col-lg-7">
                <div class="h-100 card">
                    <div class="d-flex flex-column h-100 card-body">
                        @php
                            $items = collect($semuabarang ?? []);
                            $totalBarang = $items->count();
                            $totalStok = $items->sum('jumlahbarang');
                            $lowStockCount = $items->filter(fn($i) => ($i->jumlahbarang ?? 0) <= 5)->count();
                        @endphp
                        <div class="mb-4">
                            <h5 class="mb-2 fw-bold">Selamat datang di Inventaris Admin</h5>
                            <p class="mb-0 text-muted">Pantau stok, tambah barang, dan kelola permintaan dengan cepat.</p>
                        </div>
                        <div class="mb-4 row g-3">
                            <div class="col-sm-4">
                                <div class="bg-light p-3 border rounded-3 h-100">
                                    <div class="text-muted small">Total Barang</div>
                                    <div class="fw-bold fs-4">{{ $totalBarang }}</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="bg-light p-3 border rounded-3 h-100">
                                    <div class="text-muted small">Total Stok</div>
                                    <div class="fw-bold fs-4">{{ $totalStok }} pcs</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="bg-light p-3 border rounded-3 h-100">
                                    <div class="text-muted small">Perlu Restock</div>
                                    <div class="fw-bold fs-4">{{ $lowStockCount }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-light mb-4 p-3 border rounded-3">
                            <ul class="mb-0 text-muted small">
                                <li>Lihat barang terbaru di sisi kanan.</li>
                                <li>Perhatikan stok menipis di Stock Alert.</li>
                                <li>Kelola permintaan pada menu Permintaan.</li>
                            </ul>
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-auto">
                            <a href="{{ route('viewbarang') }}" class="btn btn-primary btn-sm">Kelola barang</a>
                            @if (Route::has('requests.index'))
                                <a href="{{ route('requests.index') }}" class="btn-outline-secondary btn btn-sm">Lihat permintaan</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="h-100 card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div>
                                <h5 class="mb-1 fw-bold">Barang terbaru</h5>
                                <p class="mb-0 text-muted">3 item terakhir masuk</p>
                            </div>
                            <a href="{{ route('viewbarang') }}" class="btn btn-sm btn-primary">Tambah</a>
                        </div>
                        @php $latestItems = collect($semuabarang ?? [])->sortByDesc('id')->take(3); @endphp
                        @forelse ($latestItems as $item)
                            @php
                                $img = $item->fotobarang
                                    ? asset('fotobarang/'.$item->fotobarang)
                                    : 'https://via.placeholder.com/160x120?text=No+Image';
                            @endphp
                            <div class="mb-3 p-3 latest-card">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $img }}" alt="foto {{ $item->namabarang }}" class="me-3 latest-img">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div>
                                                <small class="text-muted">ID: {{ $item->id }}</small>
                                                <h6 class="mb-1 fw-bold">{{ $item->namabarang }}</h6>
                                                <div class="text-muted">Kategori: {{ $item->category->name ?? '-' }}</div>
                                                <div class="text-muted">Supplier: {{ $item->supplier->name ?? '-' }}</div>
                                                <div class="fw-semibold">Rp{{ number_format($item->hargabarang, 0, ',', '.') }} - {{ $item->jumlahbarang }} pcs</div>
                                            </div>
                                            <div class="btn-group">
                                                <a href="{{ route('editform', ['id' => $item->id]) }}" class="btn-outline-secondary btn btn-sm btn-edit-sm">Edit</a>
                                                <form method="POST" action="{{ route('delete', ['id' => $item->id]) }}" class="d-inline mb-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn-outline-danger btn btn-sm btn-delete-sm">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="border alert alert-light">Belum ada barang yang tercatat.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h5 class="mb-1 fw-bold">Stock Alert</h5>
                        <p class="mb-0 text-muted">Pantau barang di bawah ambang aman</p>
                    </div>
                    <span class="text-bg-warning text-dark badge">Auto generated</span>
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
                                    <td class="text-center"><= 5 pcs</td>
                                    <td class="text-end">
                                        <span class="text-bg-danger badge">Perlu Restock</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-4 text-muted text-center">Stok aman. Tidak ada peringatan.</td>
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



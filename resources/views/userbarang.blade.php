<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Barang | Inventaris</title>
    <link rel="stylesheet" href="{{ asset('css/add.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @include('LayOut.user_styles')
    <style>
        .form-label { font-weight: 600; color: #1d2433; }
        .table thead th { background: #f8f9fd; }
        .thumb { width: 60px; height: 60px; object-fit: cover; border-radius: 10px; border: 1px solid #e6e9ef; }
    </style>
</head>

<body>
    @include('LayOut.user_nav', ['subtitle' => 'Barang'])
    <div class="d-flex app-shell">
            @include('LayOut.user_sidebar')
        <main class="main-content">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="fw-bold mb-1">Semua Barang</h5>
                            <p class="text-muted mb-0">Lihat seluruh barang yang tersedia.</p>
                        </div>
                </div>
                <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Barang</th>
                                    <th>Kategori</th>
                                    <th>Supplier</th>
                                    <th class="text-end">Harga</th>
                                    <th class="text-center">Stok</th>
                                    @if (Route::has('requests.create'))
                                        <th class="text-end">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($semuabarang ?? [] as $item)
                                    @php
                                        $img = $item->fotobarang
                                            ? asset('fotobarang/' . $item->fotobarang)
                                            : 'https://via.placeholder.com/120x90?text=No+Image';
                                    @endphp
                                    <tr>
                                        <td class="fw-semibold">{{ $item->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ $img }}" alt="foto {{ $item->namabarang }}"
                                                    style="width:60px;height:60px;object-fit:cover;border-radius:10px;border:1px solid #e6e9ef;">
                                                <div>
                                                    <div class="fw-semibold">{{ $item->namabarang }}</div>
                                                    <small class="text-muted">Rp{{ number_format($item->hargabarang, 0, ',', '.') }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->category->name ?? '-' }}</td>
                                        <td>{{ $item->supplier->name ?? '-' }}</td>
                                        <td class="text-end">Rp{{ number_format($item->hargabarang, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center fw-semibold">{{ $item->jumlahbarang }} pcs</td>
                                        @if (Route::has('requests.create'))
                                            <td class="text-end">
                                                <a href="{{ route('requests.create', ['barang_id' => $item->id]) }}"
                                                    class="btn btn-outline-primary btn-sm">Ajukan</a>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">Belum ada barang yang
                                            tercatat.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>





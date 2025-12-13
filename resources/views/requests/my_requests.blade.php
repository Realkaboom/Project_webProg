<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Permintaan | Inventaris</title>
    <link rel="stylesheet" href="{{ asset('css/add.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @include('LayOut.user_styles')
    <style>
        .table thead th { background: #f8f9fd; }
    </style>
</head>
<body>
@include('LayOut.user_nav', ['subtitle' => 'Permintaan'])
<div class="d-flex app-shell">
        @include('LayOut.user_sidebar')
    <main class="main-content">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between mb-3">
            <div>
                <h4 class="mb-1 fw-bold">Riwayat permintaan</h4>
                <p class="mb-0 text-muted">Riwayat permintaan barang yang sudah kamu buat.</p>
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
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h6 class="mb-1 fw-bold">Daftar Permintaan</h6>
                        <p class="mb-0 text-muted">{{ count($requests) }} permintaan tercatat.</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $req)
                                @php
                                    $status = strtolower($req->status);
                                    $badgeClass = match($status) {
                                        'approved' => 'text-bg-success',
                                        'rejected' => 'text-bg-danger',
                                        default => 'text-bg-warning text-dark',
                                    };
                                @endphp
                                <tr>
                                    <td class="fw-semibold">{{ $req->id }}</td>
                                    <td>
                                        <div class="fw-semibold">{{ $req->barang->namabarang ?? '-' }}</div>
                                        <small class="text-muted">Stok: {{ $req->barang->jumlahbarang ?? 0 }}</small>
                                    </td>
                                    <td>{{ $req->quantity }}</td>
                                    <td>
                                        <span class="badge {{ $badgeClass }}">{{ ucfirst($req->status) }}</span>
                                    </td>
                                    <td>{{ $req->note ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 text-muted text-center">Belum ada permintaan.</td>
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




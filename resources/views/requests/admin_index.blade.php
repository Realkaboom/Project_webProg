<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Permintaan Barang | Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @include('LayOut.admin_styles')
</head>
<body>
@include('LayOut.admin_nav', ['subtitle' => 'Permintaan'])
<div class="d-flex app-shell">
    @include('LayOut.admin_sidebar')
    <main class="main-content">
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




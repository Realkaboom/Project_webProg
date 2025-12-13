<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Kategori | Inventaris</title>
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
@include('lay-out.admin-nav')
<div class="d-flex app-shell">
    @include('LayOut.admin_sidebar')
    <main class="flex-grow-1 p-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between mb-3">
            <div>
                <h4 class="mb-1 fw-bold">Tambah Kategori</h4>
                <p class="mb-0 text-muted">Buat kategori baru untuk mengelompokkan barang.</p>
            </div>
            <a href="{{ route('categories.index') }}" class="mt-3 mt-lg-0 btn-outline-secondary btn">Kembali ke daftar</a>
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
                <form action="{{ route('categories.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="name">Nama Kategori</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama kategori" value="{{ old('name') }}" required>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('categories.index') }}" class="btn-outline-secondary btn">Batal</a>
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

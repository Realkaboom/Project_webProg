<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kategori | Inventaris</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @include('LayOut.admin_styles')
</head>
<body>
@include('LayOut.admin_nav', ['subtitle' => 'Kategori'])
<div class="d-flex app-shell">
    @include('LayOut.admin_sidebar')
    <main class="main-content">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between mb-3">
            <div>
                <h4 class="mb-1 fw-bold">Kategori</h4>
                <p class="mb-0 text-muted">Kelola daftar kategori dan tambahkan kategori baru.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="h-100 card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <h6 class="mb-1 fw-bold">Daftar Kategori</h6>
                                <p class="mb-0 text-muted">{{ count($categories) }} kategori terdaftar.</p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $cat)
                                        <tr>
                                            <td class="fw-semibold">{{ $cat->id }}</td>
                                            <td>{{ $cat->name }}</td>
                                            <td class="text-end">
                                                <div class="btn-group">
                                                    <form action="{{ route('categories.destroy', $cat->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('categories.edit', $cat->id) }}" class="btn-outline-secondary btn btn-sm">Edit</a>
                                                            <button type="submit" class="btn-outline-danger btn btn-sm">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-4 text-muted text-center">Belum ada kategori.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="h-100 card">
                    <div class="card-body">
                        <h6 class="mb-3 fw-bold">Tambah Kategori</h6>
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
                                <a href="{{ route('categories.index') }}" class="btn-outline-secondary btn">Bersihkan</a>
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




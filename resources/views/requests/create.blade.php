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
    @include('LayOut.user_styles')
    <style>
        .form-label { font-weight: 600; color: #1d2433; }
    </style>
</head>
<body>
@include('LayOut.user_nav', ['subtitle' => 'Permintaan'])
<div class="d-flex app-shell">
        @include('LayOut.user_sidebar')
    <main class="flex-grow-1 p-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between mb-3">
            <div>
                <h4 class="mb-1 fw-bold">Buat Permintaan</h4>
                <p class="mb-0 text-muted">Pilih barang, isi jumlah, dan berikan catatan jika diperlukan.</p>
            </div>
            <a href="{{ route('requests.my') }}" class="mt-3 mt-lg-0 btn-outline-secondary btn">Lihat Riwayat</a>
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
                        <a href="{{ route('viewall') }}" class="btn-outline-secondary btn">Batal</a>
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




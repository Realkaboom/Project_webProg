<!DOCTYPE html>
<html>
<head>
    <title>Buat Permintaan Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h3>Buat Permintaan Barang</h3>
        <form method="POST" action="{{ route('requests.store') }}" class="mt-3">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label class="form-label">Pilih Barang</label>
                <select name="barang_id" class="form-select">
                    <option value="">-- pilih barang --</option>
                    @foreach($barangs as $b)
                        <option value="{{ $b->id }}" @selected(old('barang_id') == $b->id)>
                            {{ $b->namabarang }} (Stok: {{ $b->jumlahbarang }}) - Supplier: {{ $b->supplier->name ?? '-' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="quantity" class="form-control" min="1" value="{{ old('quantity', 1) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Catatan (opsional)</label>
                <textarea name="note" class="form-control" rows="2">{{ old('note') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Kirim Permintaan</button>
                <a href="{{ route('viewall') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>

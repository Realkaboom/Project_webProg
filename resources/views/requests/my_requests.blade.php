<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Permintaan Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h3>Permintaan Saya</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered align-middle">
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
                @foreach($requests as $req)
                    <tr>
                        <td>{{ $req->id }}</td>
                        <td>{{ $req->barang->namabarang ?? '-' }}</td>
                        <td>{{ $req->quantity }}</td>
                        <td>{{ ucfirst($req->status) }}</td>
                        <td>{{ $req->note }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('viewall') }}" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>

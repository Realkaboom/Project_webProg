<!DOCTYPE html>
<html>
<head>
    <title>Daftar Permintaan Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h3>Daftar Permintaan</h3>

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

        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $req)
                    <tr>
                        <td>{{ $req->id }}</td>
                        <td>
                            {{ $req->barang->namabarang ?? '-' }}<br>
                            <small class="text-muted">Stok: {{ $req->barang->jumlahbarang ?? 0 }}</small>
                        </td>
                        <td>{{ $req->quantity }}</td>
                        <td>{{ $req->user->nama ?? '-' }}</td>
                        <td>{{ ucfirst($req->status) }}</td>
                        <td>
                            @if($req->status === 'pending')
                                <form action="{{ route('requests.approve', $req->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm" type="submit">Approve</button>
                                </form>
                                <form action="{{ route('requests.reject', $req->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit">Reject</button>
                                </form>
                            @else
                                <span class="text-muted">Sudah diproses</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

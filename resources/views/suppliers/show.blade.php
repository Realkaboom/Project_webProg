<!DOCTYPE html>
<html>
<head>
    <title>Detail Supplier</title>
</head>
<body>
    <h1>{{ $supplier->name }}</h1>
    <p>Kontak: {{ $supplier->contact }}</p>
    <p>Alamat: {{ $supplier->address }}</p>
    <a href="{{ route('suppliers.edit', $supplier->id) }}">Edit</a>
    <a href="{{ route('suppliers.index') }}">Kembali</a>
</body>
</html>

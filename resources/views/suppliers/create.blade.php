<!DOCTYPE html>
<html>
<head>
    <title>Tambah Supplier</title>
</head>
<body>
    <h1>Tambah Supplier</h1>
    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf
        <div>
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>
        <div>
            <label>Kontak</label>
            <input type="text" name="contact" value="{{ old('contact') }}">
        </div>
        <div>
            <label>Alamat</label>
            <textarea name="address">{{ old('address') }}</textarea>
        </div>
        <button type="submit">Simpan</button>
    </form>
    <a href="{{ route('suppliers.index') }}">Kembali</a>
</body>
</html>

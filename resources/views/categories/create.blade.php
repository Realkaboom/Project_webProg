<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori</title>
</head>
<body>
    <h1>Tambah Kategori</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div>
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>
        <div>
            <label>Deskripsi</label>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>
        <button type="submit">Simpan</button>
    </form>
    <a href="{{ route('categories.index') }}">Kembali</a>
</body>
</html>

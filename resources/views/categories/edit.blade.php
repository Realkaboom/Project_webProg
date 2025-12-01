<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
</head>
<body>
    <h1>Edit Kategori</h1>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div>
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}">
        </div>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('categories.index') }}">Kembali</a>
</body>
</html>

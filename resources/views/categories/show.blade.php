<!DOCTYPE html>
<html>
<head>
    <title>Detail Kategori</title>
</head>
<body>
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>
    <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
    <a href="{{ route('categories.index') }}">Kembali</a>
</body>
</html>

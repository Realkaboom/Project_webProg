<!DOCTYPE html>
<html>
<head>
    <title>Daftar Kategori</title>
</head>
<body>
    <h1>Daftar Kategori</h1>
    <a href="{{ route('categories.create') }}">Tambah Kategori</a>
    <ul>
        @foreach($categories as $cat)
            <li>
                <strong>{{ $cat->name }}</strong> - {{ $cat->description }}
                <a href="{{ route('categories.show', $cat->id) }}">Detail</a>
                <a href="{{ route('categories.edit', $cat->id) }}">Edit</a>
                <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" style="display:inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>

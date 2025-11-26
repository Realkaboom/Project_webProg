<!DOCTYPE html>
<html>
<head>
    <title>Daftar Supplier</title>
</head>
<body>
    <h1>Daftar Supplier</h1>
    <a href="{{ route('suppliers.create') }}">Tambah Supplier</a>
    <ul>
        @foreach($suppliers as $sup)
            <li>
                <strong>{{ $sup->name }}</strong> - {{ $sup->contact }} - {{ $sup->address }}
                <a href="{{ route('suppliers.show', $sup->id) }}">Detail</a>
                <a href="{{ route('suppliers.edit', $sup->id) }}">Edit</a>
                <form action="{{ route('suppliers.destroy', $sup->id) }}" method="POST" style="display:inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>

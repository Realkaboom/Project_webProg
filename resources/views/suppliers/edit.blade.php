<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier</title>
</head>
<body>
    <h1>Edit Supplier</h1>
    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div>
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name', $supplier->name) }}">
        </div>
        <div>
            <label>Kontak</label>
            <input type="text" name="contact" value="{{ old('contact', $supplier->contact) }}">
        </div>
        <div>
            <label>Alamat</label>
            <textarea name="address">{{ old('address', $supplier->address) }}</textarea>
        </div>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('suppliers.index') }}">Kembali</a>
</body>
</html>

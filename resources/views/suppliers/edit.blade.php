<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Supplier</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root { --primary: #0d1b3d; }
        body { background: #eef1f5; font-family: 'Figtree', sans-serif; }
        .form-label { font-weight: 600; color: #1d2433; }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <h1>Edit Supplier</h1>
            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $supplier->name) }}">
                </div>
                <div class="mb-3">
                    <label>Kontak</label>
                    <input type="text" name="contact" class="form-control" value="{{ old('contact', $supplier->contact) }}">
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="address" class="form-control">{{ old('address', $supplier->address) }}</textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('suppliers.index') }}" class="btn-outline-secondary btn">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | Warehouse.in</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: #eef1f5;
            font-family: 'Figtree', sans-serif;
        }

        .hero-card {
            background: #fff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.08);
        }

        .input-large {
            height: 52px;
            font-size: 1rem;
        }

        .btn-dark-blue {
            background: #0d1b3d;
            color: #fff;
            border-radius: 10px;
            padding: 12px;
            border: none;
            font-weight: 600;
        }

        .btn-dark-blue:hover {
            background: #0a1530;
        }

        .helper-text {
            color: #6c7685;
        }

        .form-label {
            font-weight: 600;
            color: #1d2433;
        }
    </style>
</head>

<body>
    <div class="container py-5 py-md-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="hero-card p-4 p-md-5">
                    <h3 class="fw-bold mb-3">Register</h3>
                    <p class="mb-4 helper-text">
                        Manage all your inventory efficiently.<br>
                        Let's get you set up so you can verify your account and begin.
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <form action="{{ route('registered') }}" method="POST" novalidate>
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="nama">Name</label>
                                <input type="text" class="form-control input-large" id="nama" name="nama"
                                    placeholder="Enter your name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="nomorhp">Phone no.</label>
                                <input type="tel" class="form-control input-large" id="nomorhp" name="nomorhp"
                                    placeholder="Minimum 8 characters" autocomplete="tel" inputmode="tel"
                                    pattern="^[0-9+\s-]{8,15}$"
                                    title="Hanya masukkan angka, spasi, tanda + atau - (8-15 karakter)">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control input-large" id="email" name="email"
                                    placeholder="Enter your email" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control input-large" id="password" name="password"
                                    placeholder="Minimum 8 characters" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-dark-blue w-100">Sign up</button>
                        </div>
                        <div class="text-muted">
                            Already have an account? <a href="{{ route('login') }}">Log in</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>

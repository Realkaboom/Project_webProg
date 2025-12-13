<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Warehouse.in</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 10% 10%, #4a4a4a, #1f1f1f);
            font-family: 'Figtree', sans-serif;
        }

        .auth-card {
            max-width: 460px;
            width: 100%;
            border: none;
            border-radius: 18px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
        }

        .brand-title {
            letter-spacing: 0.5px;
        }

        .input-icon {
            position: absolute;
            left: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .form-control.with-icon {
            padding-left: 2.5rem;
            height: 52px;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #6c757d;
            font-weight: 600;
            letter-spacing: 0.8px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #d8d8d8;
        }
    </style>
</head>

<body>
    <div class="px-3 py-5 container">
        <div class="mb-4 text-white text-center">
            <h2 class="fw-bold brand-title">Warehouse.in</h2>
        </div>
        <div class="mx-auto card auth-card">
            <div class="p-4 p-md-5 card-body">
                <h4 class="mb-4 text-center fw-bold">USER LOGIN</h4>

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

                <form action="{{ route('logedin') }}" method="POST" novalidate>
                    @csrf
                    <div class="position-relative mb-3">
                        <span class="input-icon"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control with-icon" name="email" placeholder="Email"
                            required>
                    </div>
                    <div class="position-relative mb-3">
                        <span class="input-icon"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control with-icon" name="password" placeholder="Password"
                            required>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="py-2 btn btn-dark fw-semibold">Login</button>
                    </div>
                    <div class="mb-3 text-center divider">OR</div>
                    <div class="text-center">
                        <span class="text-muted">Don't have an account?</span>
                        <a href="{{ route('register') }}">Sign up here.</a>
                    </div>
                </form>
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

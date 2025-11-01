<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* 🎨 Fondo global */
        body {
            background: url("{{ asset('images/image.png') }}") center/cover no-repeat fixed;
            min-height: 100vh;
            position: relative;
            z-index: 0;
        }

        /* 🌫️ Capa translúcida para que el fondo no distraiga */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            z-index: -1;
        }

        /* 🌈 Barra de navegación con degradado verde */
        .navbar-custom {
            background: linear-gradient(90deg, #3d89bb, #28509b);
        }

        .navbar-custom .navbar-brand span,
        .navbar-custom .text-light,
        .navbar-custom .btn-outline-light {
            color: #fff !important;
        }

        .navbar-custom .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom shadow-sm mb-4">
        <div class="container d-flex justify-content-between align-items-center">

            <!-- 🖼️ Logo + título -->
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/dashboard') }}">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" width="45" height="45" class="rounded-circle me-2">
                <span class="fw-bold fs-5">Sistema de Inventario MH</span>
            </a>

            <!-- 👤 Usuario + botón salir -->
            @auth
            <div class="d-flex align-items-center">
                <span class="text-light me-3">
                    <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i> Salir
                    </button>
                </form>
            </div>
            @endauth

        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>

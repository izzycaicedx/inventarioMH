<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Inventario</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Enlace a PRODUCTOS (existente) -->
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('productos.index') }}">Productos</a>
                    </li>
                    
                    <!-- Enlace a EMPLEADOS (NUEVO BOTÓN) -->
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('empleados.index') }}">Empleados</a>
                    </li>
                    
                    <!-- Aquí se pueden añadir más enlaces como Categorías, etc. -->
                </ul>
                <!-- Puedes añadir aquí enlaces de usuario o logout si los necesitas -->
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

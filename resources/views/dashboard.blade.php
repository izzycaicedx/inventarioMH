@extends('layouts.app')

@section('content')
<style>
    /* Fondo general */
    body {
        background: url("{{ asset('images/image.png') }}") center/cover no-repeat fixed;
        position: relative;
        min-height: 100vh;
    }

    /* Capa blanca translúcida encima del fondo */
    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.85);
        z-index: -1;
    }

    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .dashboard-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .dashboard-header h1 {
        font-weight: 700;
        color: #0a0c01;
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        background-color: #fff;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .card i {
        font-size: 3rem;
        color: #0d6efd;
    }

    .card-title {
        font-weight: 600;
        color: #343a40;
    }

    .btn-custom {
        border-radius: 50px;
        padding: 0.5rem 1.2rem;
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Panel de Control</h1>
        <p class="text-muted">Bienvenido al sistema de inventario — selecciona una opción</p>
    </div>

    <div class="row g-4">
        <!-- Productos -->
        <div class="col-md-3">
            <div class="card text-center p-4">
                <i class="bi bi-box-seam mb-3"></i>
                <h5 class="card-title">Gestión de Productos</h5>
                <p class="text-muted">Agrega, edita o elimina productos del inventario.</p>
                <a href="{{ route('productos.index') }}" class="btn btn-primary btn-custom">Ver Productos</a>
            </div>
        </div>

        <!-- Empleados -->
        <div class="col-md-3">
            <div class="card text-center p-4">
                <i class="bi bi-people mb-3"></i>
                <h5 class="card-title">Gestión de Empleados</h5>
                <p class="text-muted">Administra los empleados registrados en el sistema.</p>
                <a href="{{ route('empleados.index') }}" class="btn btn-primary btn-custom">Ver Empleados</a>
            </div>
        </div>

        <!-- Ventas -->
        <div class="col-md-3">
            <div class="card text-center p-4">
                <i class="bi bi-cash-stack mb-3"></i>
                <h5 class="card-title">Gestión de Ventas</h5>
                <p class="text-muted">Registra y consulta las ventas realizadas.</p>
                <a href="{{ route('ventas.index') }}" class="btn btn-primary btn-custom">Ver Ventas</a>
            </div>
        </div>

        <!-- Reportes -->
        <div class="col-md-3">
            <div class="card text-center p-4">
                <i class="bi bi-file-earmark-text mb-3"></i>
                <h5 class="card-title">Reportes</h5>
                <p class="text-muted">Genera reportes y exporta datos en formato PDF.</p>
                <a href="{{ route('productos.pdf') }}" class="btn btn-primary btn-custom">Ver Reportes</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
@endsection

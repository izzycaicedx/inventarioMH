@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center">Registrar Venta</h1>

    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="metodo_pago" class="form-label">Método de Pago</label>
            <select name="metodo_pago" id="metodo_pago" class="form-select" required>
                <option value="Efectivo">Efectivo</option>
                <option value="Tarjeta">Tarjeta</option>
                <option value="Transferencia">Transferencia</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Seleccionar Productos</label>

            @if ($productos->isEmpty())
                <p class="text-danger">⚠ No hay productos registrados en el inventario.</p>
            @else
                <div class="row">
                    @foreach ($productos as $index => $producto)
                        <div class="col-md-4">
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                                    <p class="text-muted mb-1">Stock: {{ $producto->cantidad }}</p> {{-- CAMBIADO: stock por cantidad --}}
                                    <p class="text-muted mb-1">
                                        Precio: $<span class="precio">{{ number_format($producto->precio, 2, '.', '') }}</span> {{-- CAMBIADO: precio_unitario por precio --}}
                                    </p>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input producto-checkbox" type="checkbox"
                                               id="prod{{ $index }}"
                                               name="productos[{{ $index }}][id]"
                                               value="{{ $producto->id }}">
                                        <label class="form-check-label" for="prod{{ $index }}">Seleccionar</label>
                                    </div>

                                    <input type="number"
                                           name="productos[{{ $index }}][cantidad]"
                                           class="form-control cantidad-input"
                                           min="1"
                                           max="{{ $producto->cantidad }}" {{-- CAMBIADO: stock por cantidad --}}
                                           placeholder="Cantidad"
                                           disabled
                                           style="width: 100px; margin: 0 auto;">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mb-4 text-center">
            <h4>
                💰 Total: <span id="totalDisplay">$0.00</span>
            </h4>
            <input type="hidden" name="total" id="total" value="0">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success px-4">
                <i class="bi bi-save"></i> Guardar Venta
            </button>
            <a href="{{ route('ventas.index') }}" class="btn btn-secondary px-4">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </form>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Script para cálculo automático -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.producto-checkbox');
    const cantidades = document.querySelectorAll('.cantidad-input');
    const totalDisplay = document.getElementById('totalDisplay');
    const totalInput = document.getElementById('total');

    function formatoMoneda(numero) {
        return new Intl.NumberFormat('es-CO', {
            style: 'currency',
            currency: 'COP',
            minimumFractionDigits: 0
        }).format(numero);
    }

    function calcularTotal() {
        let total = 0;

        checkboxes.forEach((checkbox, i) => {
            if (checkbox.checked) {
                const card = checkbox.closest('.card-body');
                const precio = parseFloat(card.querySelector('.precio').textContent);
                const cantidad = parseInt(cantidades[i].value) || 0;
                total += precio * cantidad;
            }
        });

        totalInput.value = total.toFixed(2);
        totalDisplay.textContent = formatoMoneda(total);
    }

    checkboxes.forEach((checkbox, i) => {
        checkbox.addEventListener('change', () => {
            cantidades[i].disabled = !checkbox.checked;
            if (!checkbox.checked) {
                cantidades[i].value = '';
            }
            calcularTotal();
        });
    });

    cantidades.forEach(input => {
        input.addEventListener('input', calcularTotal);
    });

    // Validar cantidad máxima al enviar el formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        let valid = true;

        checkboxes.forEach((checkbox, i) => {
            if (checkbox.checked) {
                const cantidadInput = cantidades[i];
                const maxStock = parseInt(cantidadInput.getAttribute('max'));
                const cantidad = parseInt(cantidadInput.value) || 0;

                if (cantidad > maxStock) {
                    alert('❌ La cantidad de ' + checkbox.closest('.card-body').querySelector('.card-title').textContent + ' no puede ser mayor al stock disponible (' + maxStock + ')');
                    valid = false;
                }

                if (cantidad <= 0) {
                    alert('❌ La cantidad de ' + checkbox.closest('.card-body').querySelector('.card-title').textContent + ' debe ser mayor a 0');
                    valid = false;
                }
            }
        });

        if (!valid) {
            e.preventDefault();
        }
    });
});
</script>
@endsection

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Ventas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h1 { color: #333; margin: 0; }
        .info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f8f9fa; font-weight: bold; }
        .total-row { background-color: #e9ecef; font-weight: bold; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Ventas</h1>
        <p>Generado el: {{ date('d/m/Y H:i') }}</p>
    </div>

    <div class="info">
        <p><strong>Total de Ventas:</strong> {{ $ventas->count() }}</p>
        <p><strong>Ventas Totales:</strong> ${{ number_format($ventas->sum('total'), 2) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Total</th>
                <th>Método Pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>
                    @if($venta->fecha instanceof \Carbon\Carbon)
                        {{ $venta->fecha->format('d/m/Y H:i') }}
                    @else
                        {{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y H:i') }}
                    @endif
                </td>
                <td>{{ $venta->usuario->name ?? 'N/A' }}</td>
                <td class="text-right">${{ number_format($venta->total, 2) }}</td>
                <td class="text-center">{{ $venta->metodo_pago }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3" class="text-right"><strong>Total General:</strong></td>
                <td class="text-right"><strong>${{ number_format($ventas->sum('total'), 2) }}</strong></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>

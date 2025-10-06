<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Productos</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Listado de Productos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->nombre }}</td>
                    <td>{{ $p->descripcion }}</td>
                    <td>{{ $p->cantidad }}</td>
                    <td>${{ number_format($p->precio, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

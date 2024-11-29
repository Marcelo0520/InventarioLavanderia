<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte General de Inventario</title>
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            margin: 0;
            padding: 0;
            background-color: #f9f9f9; 
            color: #333;
        }
        h1, h2, h4 {
            text-align: center;
            margin: 0;
            padding: 10px;
            text-transform: capitalize;
        }
        h1 {
            font-size: 28px;
            color: #0056b3;
        }
        h2 {
            font-size: 22px;
            margin-top: 10px;
            color: #444;
        }
        h4 {
            font-size: 18px;
            margin: 10px 0;
            color: #555;
            text-align: center;
        }

        /* Table Styles */
        .table-container {
            width: 90%;
            margin: 20px auto;
            border-radius: 8px;
            overflow: hidden;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            text-align: left; 
        }
        thead {
            background-color: #0056b3;
            color: #fff;
        }
        th, td {
            padding: 12px 15px;
        }
        th {
            font-size: 16px;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #e9f5ff;
        }
        tbody td {
            font-size: 14px;
            text-align: center;
        }

        span {
            font-weight: bold;
            color: #0056b3;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>Reporte General de Inventario por Ubicación y Tipo de Ropa</h1>

    @if (Auth::check())
        <h4>Reporte generado por <span>{{ Str::replace('_', ' ', Auth::user()->username) }}</span> 
        como usuario <span>{{ Str::replace('_', ' ', Auth::user()->role) }}</span></h4>
    @endif

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Ubicación</th>
                    <th>Tipo de Ropa</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reportesPorUbicacion as $ubicacion => $ropas)
                    <!-- Fila para el nombre de la ubicación -->
                    <tr>
                        <td colspan="4" style="font-weight: bold; font-size: 16px; text-transform: capitalize; color: #0056b3;">
                            {{ $ubicacion }}
                        </td>
                    </tr>
                    @foreach ($ropas as $ropa)
                        <tr>
                            <td>{{ $ropa->inventario->ubicacion->tipoArea}} - {{ $ropa->inventario->ubicacion->departamento}}</td>
                            <td style="text-transform: capitalize">{{ $ropa->tipo ?? 'Desconocido' }}</td>
                            <td>{{ $ropa->cantidad }}</td>
                            <td style="text-transform: capitalize">{{ $ropa->estado }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <footer>
        <p>Reporte generado automáticamente el {{ now()->format('d/m/Y H:i') }}</p>
    </footer>
</body>
</html>

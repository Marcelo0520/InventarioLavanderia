<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte por Tipo</title>
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
            text-transform: capitalize
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
        span {
            font-weight: bold;
            color: #0056b3;
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
            text-align: center
        }

        /* Footer Styles */
        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>Reporte de Inventario por Tipo de Ropa</h1>
    <h2>Tipo: {{ $tipo }}</h2>

    @if (Auth::check())
        <h4>Reporte generado por <span>{{ Str::replace('_', ' ', Auth::user()->username) }}</span> 
        como usuario <span>{{ Str::replace('_', ' ', Auth::user()->role) }}</span></h4>
    @endif

            

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th>Ubicación</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reportes as $ropa)
                <tr>
                    <td>{{ $ropa->cantidad }}</td>
                    <td>
                        <span style="text-transform: capitalize;">
                            {{ $ropa->estado }}
                        </span>
                    </td>
                    <td>
                        {{ $ropa->inventario->ubicacion->nombre ?? 'Sin ubicación' }} -
                        {{ $ropa->inventario->ubicacion->tipoArea }} -
                        {{ $ropa->inventario->ubicacion->departamento }} -
                        Piso {{ $ropa->inventario->ubicacion->nivelPiso }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <footer>
        <p>Reporte generado automáticamente el {{ now()->format('d/m/Y H:i') }}</p>

    </footer>
</body>
</html>

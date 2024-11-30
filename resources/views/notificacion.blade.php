<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alerta de Nivel Crítico de Inventario</title>
</head>
<body>
    <p>⚠️ <strong>Alerta de Nivel Crítico</strong></p>
    
    <p>El inventario en la ubicación <strong>{{ $ubicacion_nombre }}</strong> (Tipo de área: {{ $ubicacion_tipo_area }}, Piso: {{ $ubicacion_piso }}) ha alcanzado un nivel crítico.</p>

    <p><strong>Ropa con escasez:</strong></p>
    <ul>
        @foreach ($ropas_con_escasez as $ropa)
            <li>
                <strong>Tipo de ropa:</strong> {{ $ropa['tipo'] }}<br>
                <strong>Cantidad disponible:</strong> {{ $ropa['cantidad'] }} unidades
            </li>
        @endforeach
    </ul>

    <p><strong>Nivel crítico definido:</strong> 25 unidades</p>
    <p>Por favor, tome las medidas necesarias para reabastecer el inventario.</p>
</body>
</html>

@extends('layout')

@section('title','Reporte por tipo de ropa')

@section('content')

<div class="container__reporte">
    <h2 class="atractive__title">Reporte inventario por tipo de ropa</h1>

    <table>
        <thead>
            <tr>
                <th>Tipo de Ropa</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>Ubicación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportes as $tipo => $ropas) 
                <tr>
                    <td  style="text-transform: capitalize;text-align: center; font-weight: bold; font-size: 18px">{{ $tipo }}</td>
                </tr>
                @foreach ($ropas as $ropa) 
                    <tr>
                        <td></td> 
                        <td >{{ $ropa->cantidad }}</td>
                        <td style="text-transform: capitalize" class="{{ $ropa->estado}}"> {{ $ropa->estado}} </td>
                        <td>{{ $ropa->inventario->ubicacion->nombre  ?? 'Sin ubicación' }} - {{ $ropa->inventario->ubicacion->tipoArea}} - {{ $ropa->inventario->ubicacion->departamento}}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>

@endsection
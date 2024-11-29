@extends('layout')

@section('title','Reporte por ubicación')

@section('content')

    <div class="container__reporte">
        <h2 class="atractive__title">Reporte por Ubicación</h2>

        <table>
            <thead>
                <tr>
                    <th>Ubicación</th>
                    <th>Tipo de Ropa</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody class="tbody">
                @foreach ($reportesPorUbicacion as $ubicacion => $ropas)
                    <tr>
                        <td style="text-align: center; font-weight: bold; font-size: 18px; text-transform: capitalize;">
                            {{ $ubicacion }}
                        </td>
                    </tr>
                    @foreach ($ropas as $ropa)
                        <tr>
                            <td></td>
                            <td style="text-transform: capitalize;color:gray;">{{ $ropa->tipo }}</td>
                            <td>{{ $ropa->cantidad }}</td>
                            <td style="text-transform: capitalize" class="{{ $ropa->estado}}"> {{ $ropa->estado}} </td>
                            </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

@endsection


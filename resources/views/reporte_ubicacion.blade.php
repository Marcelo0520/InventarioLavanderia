@extends('layout')

@section('title','Reporte por ubicación')

@section('content')

    <div class="container__reporte">
        <h2 class="atractive__title">Reporte de inventario por Ubicación</h2>

        <h4 style="margin: 2em 0 1em 0;padding-bottom: .5em;">Descargar reporte de inventario general</h4>
        <a href="{{route('reporte.general')}}" class="btn btn-primary">
            Descargar PDF 
        </a>

        <table>
            <thead>
                <tr>
                    <th>Ubicación</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Descargar reporte</th>
                </tr>
            </thead>
            <tbody class="tbody">
                @foreach ($reportesPorUbicacion as $ubicacion => $ropas)
                    <tr>
                        <td style="text-align: center; font-weight: bold; font-size: 18px; text-transform: capitalize;color: black">
                            {{ $ubicacion }}
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="{{ route('reporte.ubicacion.pdf', $ubicacion) }}" class="btn btn-primary">
                                Descargar PDF
                            </a>
                        </td>
                    </tr>
                       
                @endforeach
            </tbody>
        </table>
    </div>

@endsection


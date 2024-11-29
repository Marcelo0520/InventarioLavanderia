@extends('layout')

@section('title','Reporte por tipo de ropa')

@section('content')

<div class="container__reporte">
    <h2 class="atractive__title">Reporte de inventario por tipo de ropa</h1>


    <h4 style="margin: 2em 0 1em 0">Descargar reporte de inventario general</h4>

        <a href="{{ route('reporte.general.pdf') }}" class="btn btn-primary">
            Descargar PDF
        </a>

    <table>
        <thead>
            <tr>
                <th>Tipo de Ropa</th>
                <th></th>
                <th></th>
                <th></th>
                <th>Descargar reporte</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportes as $tipo => $ropas) 
            <tr>
                <td style="text-transform: capitalize; font-weight: bold; font-size: 18px;color: black">
                    {{ $tipo }}
                </td>

                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="{{ route('reporte.tipo.pdf', $tipo) }}" class="btn btn-primary">
                        Descargar PDF
                    </a>
                </td>
            </tr>
  
            @endforeach
        </tbody>
    </table>
</div>

@endsection
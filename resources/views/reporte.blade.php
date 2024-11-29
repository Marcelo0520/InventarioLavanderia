@extends('layout')

@section('title', 'Reporte de inventario por tipo y ubicacion')


@section('content')
<div class="container__reporte">
    <h1 class="atractive__title">Opciones de reporte de inventario</h1>

    <p style="color: black;font-size:1.2em;">Hemos desglosado las opciones de inventario en 2, la primera te permitirá saber todo el 
        inventario agrupado por tipo de ropa, incluyendo <span style="color:#2ecc71;font-weight:bold;">limpia</span> y <span style="color:#e74c3c;font-weight:bold;">sucia</span>, la segunda opción te permitirá saber acerca del inventario de todas las ubicaciones existentes.</p>



    <div class="report__options" style="display: flex;justify-content:space-between;">
        <div class="container__report__option">
            <a  href="{{ route('reporte.tipo') }}" class="report__option">Reporte por Tipo de Ropa</a>

        </div>
        <div class="container__report__option">
            <a href="{{ route('reporte.ubicacion') }}" class="report__option">Reporte por Ubicación</a>
        </div>
    </div>
    
    <div class="container__svg__reporte">
        <img src="{{asset('imagenes/reporte.svg')}}" alt="">
        <img src="{{asset('imagenes/reporte_doctor.svg')}}" alt="">
    </div>

    
</div>
@endsection

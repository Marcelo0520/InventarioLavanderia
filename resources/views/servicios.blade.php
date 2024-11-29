@extends('layout')

@section('title', 'Servicios de la aplicación')

@section('content')

    <div class="container-img">
        <img src="{{ asset('imagenes/sanjose.jpg') }}" alt="">

        <div class="titulochico">
            <h1>Hospital San José de Melipilla</h1>
        </div>
    </div>

    <div class="navegador-serv">
        @if (auth()->check())
            <h4>Servicios disponibles para usted como usuario <span> {{ Str::replace('_', ' ', auth()->user()->role) }}</span></h4>
        @endif
        <div class="container__services">
            @if (auth()->check())
                @if (auth()->user()->role === 'personal_clinico' || auth()->user()->role === 'personal_lavanderia' || auth()->user()->role === 'admin_hospital')
                    <a href="{{ route('movimiento') }}">Registrar movimiento</a>
                @endif

                @if (auth()->user()->role === 'supervisor_inventario' || auth()->user()->role === 'admin_hospital')
                    <a href="#">Transacciones</a>
                @endif

                @if (auth()->user()->role === 'admin_hospital' || auth()->user()->role === 'supervisor_inventario')
                    <a href="{{ route('reporte') }}">Reportes</a>
                @endif
            @else
                <p style="margin: 0;font-size:1.5em;">Por favor, inicie sesión para ver los servicios específicos.</p>
            @endif
        </div>
    </div>

    <div class="row-foto">
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front" style="background-color: #50DC59">
                    <img src="{{ asset('imagenes/lavadora.png') }}" alt="Avatar">
                </div>
                <div class="flip-card-back" style="background-color: #50DC59">
                    <p>Contamos con lavadoras especializadas y tecnología de última generación, junto con un equipo de
                        personal altamente capacitado.</p>
                </div>
            </div>
        </div>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front" style="background-color: #75D2F3">
                    <img src="{{ asset('imagenes/toalla.png') }}" alt="Avatar">
                </div>
                <div class="flip-card-back" style="background-color: #75D2F3">
                    <p>Manejamos con extremo cuidado cada prenda de ropa, asegurando que se sigan los protocolos más
                        estrictos de limpieza, desinfección y conservación.</p>
                </div>
            </div>
        </div>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front" style="background-color: var(--primary)">
                    <img src="{{ asset('imagenes/ropa.png') }}" alt="Avatar">
                </div>
                <div class="flip-card-back" style="background-color: var(--primary)">
                    <p>Las prendas de ropa son cuidadosamente procesadas y luego transportadas de vuelta al hospital,
                        garantizando que estén en condiciones óptimas para ser reutilizadas con la máxima seguridad e
                        higiene.</p>
                </div>
            </div>
        </div>
    </div>

@endsection

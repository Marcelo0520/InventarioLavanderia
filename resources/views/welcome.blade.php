@extends('layout')

@section('title', 'Lavanderia Hospital San José de Melipilla')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="presentacion">
            <div class="titulos">
                <h1>
                    SERVICIOS CLINICOS
                </h1>
                <img class="logoservicio" src="{{ asset('imagenes/grupo.svg') }}" alt="">
                <h1 class="lavanderia">DE LAVANDERIA EXTERNA</h1>
            </div>
            <div class="naranjo"></div>
            <div class="naranjo2"></div>
            <img class="imagen" src="{{ asset('imagenes/presentacion.jpeg') }}" alt="">
        </div>

        <div class="row-info">
            <img src="{{ asset('imagenes/doctor.svg') }}" alt="">
            <div class="info-hospital">
                <h2>Hospital San José</h2>
                <p>En nuestro hospital, contamos con un equipo de más de setenta médicos y profesionales de la salud
                    comprometidos con ofrecer atención integral y de calidad. Nuestra amplia gama de especialidades
                    garantiza que cada paciente reciba el cuidado que necesita, priorizando su bienestar y salud en todo
                    momento.
                </p>
            </div>
        </div>

        <div class="galeria">
            <h2>GALERIA</h2>
            <div class="galeria-img">
                <img src="{{ asset('imagenes/primera.png') }}" alt="">
                <img src="{{ asset('imagenes/segunda.png') }}" alt="">
                <img src="{{ asset('imagenes/tercera.png') }}" alt="">
                <img src="{{ asset('imagenes/cuarta.png') }}" alt="">
                <img src="{{ asset('imagenes/ultima.png') }}" alt="">
            </div>
        </div>

    </layout>
@endsection

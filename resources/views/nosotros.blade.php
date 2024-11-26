@extends('layout')

@section('title', 'Trabaja con nosotros')

@section('content')
    <layout>
    
        <div class="banner">
            <img src="{{ asset('imagenes/unete.png')}}" alt="">
        </div>

        <div class="naranjouno">

        </div>
        <div class="titulo-trabajacon">
            <h1>SERVICIOS CLINICOS LAVANDERIA EXTERNA</h1>
        <h1 class="lavanderia">TRABAJA CON NOSOTROS</h1>
        </div>
        <div class="contnaranjo">
            <div class="naranjodos">
                
            </div>  
        </div>

        <div class="row-trabajo">
            <div class="trabajo">
                <img src="{{asset('imagenes/health.svg')}}" alt="">
                <div class="button">
                    <a class="myButton" href="">Postulaciones disponibles</a>
                </div>
            </div>
            <div class="trabajo">
                <img src="{{asset('imagenes/medicina.svg')}}" alt="">
                <div class="button">
                    <a class="myButtonn" href="">Resultados y avances</a>
                </div>
            </div>
        </div>

        <div class="postulaciones">
            
        </div>
    </layout>
@endsection
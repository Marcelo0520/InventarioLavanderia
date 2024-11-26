@extends('layout')

@section('title', 'Sobre nosotros')

@section('content')
    <layout>

        <div class="container-img">
            <img src="{{ asset('imagenes/sanjose.jpg') }}" alt="">

            <div class="titulochico">
                <h1>Hospital San José de Melipilla</h1>
            </div>
        </div>

        <div class="navegador-serv titulo-serv">
            <div class="container-titulo-serv">
                <h2>SOBRE NOSOTROS</h2>
            </div>
        </div>

        <div class="row-about">
            <img src="{{ asset('imagenes/medicine.svg') }}" alt="">
            <p style="color: black">Somos una lavandería externa encargada del servicio de lavandería del Hospital San José
                de Melipilla. Nos
                especializamos en la limpieza, desinfección y mantenimiento de la ropa hospitalaria, garantizando estándares
                de calidad y seguridad para el bienestar de los pacientes y el personal médico. Con un equipo comprometido y
                tecnología de vanguardia, ofrecemos un servicio eficiente, confiable y oportuno.
            </p>
        </div>

        <div class="politicas">
            <div class="titulo-politica">
                <h1>NUESTRAS POLITICAS</h1>
            </div>
            <div class="row-politicas">
                <div class="container-pol">
                    <div class="head-politica">
                        <img src="{{asset('imagenes/idea.svg')}}" alt="">
                        <h3>PROFESIONALISMO</h3>
                    </div>
                    <div class="foot-politica">
                        <p>
                            Somos profesionales y contamos con la experiencia necesaria para brindar el mejor servicio
                        </p>
                    </div>
                </div>

                <div class="container-pol">
                    <div class="head-politica">
                        <img src="{{asset('imagenes/medalla.svg')}}" alt="">
                        <h3>CALIDAD DE LIMPIEZA</h3>
                    </div>
                    <div class="foot-politica">
                        <p>
                            Contamos con un equipo de vasta trayectoria quienes se aseguran de entregar el mejor trato a cada una de sus prendas.
                        </p>
                    </div>
                </div>
                
                <div class="container-pol">
                    <div class="head-politica">
                        <img src="{{asset('imagenes/checklist.svg')}}" alt="">
                        <h3>EFICIENCIA</h3>
                    </div>
                    <div class="foot-politica">
                        <p>
                            Usamos la tecnología a favor, mediante un sistema que nos permite monitorear cada lavado.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </layout>
@endsection

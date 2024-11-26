<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
    <link rel="icon" href="{{ asset('imagenes/hospital.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    <header>
        <div class="logo">
            <img src="{{ asset('imagenes/hospital.ico') }}" alt="">
        </div>
        <nav>
                    <a href="{{ route('home') }}">Inicio</a>

                    <a href="{{ route('servicios') }}">Servicios</a>

                    <a href="{{ route('about') }}">Nosotros</a>

                    <a href="{{ route('nosotros') }}">Trabaja con nosotros</a>
                <div class="usuario">
                    @if (Auth::check())
                        <span>{{ Str::replace('_', ' ', Auth::user()->username) }}</span>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" >
                                (Cerrar sesión)
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">Usuario</a>
                    @endif
                </div>
            </ul>
        </nav>
    </header>


    @yield('content')

    <footer>
        <div class="row-sections">
            <div class="hospital">
                <h3>Hospital San José de Melipilla</h3>
                <div class="links-footer">
                    <a href="">Inicio</a>
                    <a href="">Servicios</a>
                    <a href="">Nosotros</a>
                    <a href="">Trabaja con nosotros</a>
                </div>
            </div>

            <div class="hospital">
                <h3>Contáctanos</h3>
                <div class="links-footer">
                    <p>Fono: 225745555</p>
                    <p>Dirección: O'Higgins 551</p>
                </div>
            </div>

            <div class="hospital">
                <h3>Síguenos en nuestras redes</h3>
                <div class="links-footer">

                    <a href="">HospitalSanJoseMelipilla</a>
                    <a href="">SanJose_contratacion</a>
                </div>
            </div>
        </div>
        <div class="foot-footer">
            <h5>Copyrights © 2024 | All rights Reserved</h5>
            <div class="privacy">
                <h5>Privacy Policy</h5>
                <h5>Terms of use</h5>
            </div>
        </div>
    </footer>


</body>

</html>

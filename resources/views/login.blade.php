@extends('layout')

@section('title', 'Inicio de sesión')

@section('content')

  <div class="container__login">
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger mt-2">
                {{ $errors->first() }}
            </div>
        @endif
            <button type="submit" class="button__auth">Ingresar</button>
    </form>
    <div class="mt-3 registro">
        <p style="color: black">¿No tienes cuenta? <a  href="{{ route('registro') }}">Regístrate aquí</a></p>
    </div>
</div>

@endsection
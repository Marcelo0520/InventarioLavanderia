@extends('layout')

@section('title', 'Registro de usuario')

@section('content')

<div class="container__register" style="max-width: 400px; margin: auto; margin-top: 50px;">
  <h2>Registro de Usuario</h2>
  <form method="POST" action="{{ route('registro') }}">
      @csrf
      <div class="form-group">
          <label for="username">Nombre de Usuario</label>
          <input type="text" name="username" id="username" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="email">Correo Electrónico</label>
          <input type="email" name="email" id="email" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" name="password" id="password" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="password_confirmation">Confirmar Contraseña</label>
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="role">Tipo de Usuario:</label>
          <select name="role" id="role" class="form-control" required>
              <option value="">Seleccionar...</option>
              <option value="admin_hospital">Administrador del Hospital</option>
              <option value="supervisor_inventario">Supervisor de Inventario</option>
              <option value="personal_lavanderia">Personal de Lavandería</option>
              <option value="personal_clinico">Personal Clínico</option>
          </select>
      </div>
      @if ($errors->any())
          <div class="alert alert-danger mt-2">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <div class="form-group mt-3">
          <button type="submit" class="button__auth">Registrarse</button>
      </div>
  </form>
  <div class="mt-3">
      <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a></p>
  </div>
</div>

@endsection
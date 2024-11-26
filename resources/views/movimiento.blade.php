@extends('layout')

@section('title','Movimientos')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    
@endif
<div class="container__form">

    <h1>Registrar movimiento</h1>

    <form action="{{ route('movimiento.store') }}" method="POST">
        @csrf
        
        <!-- Tipo de Movimiento -->
        <div class="container__input">
            <label for="tipoMov">Tipo de Movimiento:</label>
        <select name="tipoMov" id="tipoMov" required>
            <option value="Ingreso">Ingreso</option>
            <option value="Egreso">Egreso</option>
        </select>
    
        <!-- Cantidad -->
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" required min="1">
    
        <!-- Tipo de Ropa -->
        <label for="tipoRopa">Tipo de Ropa:</label>
        <select name="tipoRopa" id="tipoRopa" required>
            <option value="sabanas">Sábanas</option>
            <option value="almohadas">Almohadas</option>
            <option value="batas">Batas</option>
            <option value="interior">Interior</option>
        </select>
    
        <!-- Ubicación -->
        <label for="ubicacion_id">Ubicación:</label>
        <select name="ubicacion_id" id="ubicacion_id" required>
            @foreach ($ubicaciones as $ubicacion)
            <option value="{{ $ubicacion->id }}">
                {{ $ubicacion->nombre }} {{$ubicacion->tipoArea}} - {{$ubicacion->departamento}} Piso {{ $ubicacion->nivelPiso }}
            </option>
            @endforeach
        </select>
        <button type="submit">Registrar Movimiento</button>
        </div>
        <!-- Botón de envío -->

    </form>
    




</div>

@endsection
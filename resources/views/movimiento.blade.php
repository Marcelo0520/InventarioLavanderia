@extends('layout')

@section('title','Movimientos')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="container__form">

    <h1>Registro de movimiento</h1>

    <form action="{{ route('movimiento.store') }}" method="POST">
        @csrf
        
        <!-- Tipo de Movimiento -->
        <div class="container__input">
            <label for="tipoMov">Tipo de Movimiento:</label>
        <select  class="form-select" name="tipoMov" id="tipoMov" required>
            <option value="Ingreso">Ingreso</option>
            <option value="Egreso">Egreso</option>
        </select>
    
        <div class="mb-3">
            <!-- Cantidad -->
        <label for="cantidad" class="form-label">Cantidad:</label>
        <input class="form-control" type="number" name="cantidad" id="cantidad" required min="1">
        </div>
    
        <div class="container__input">
            <label for="estado">Estado de la Ropa</label>
            <select  class="form-select" id="estado" name="estado" class="form-control" required>
                <option value="limpia">Limpia</option>
                <option value="sucia">Sucia</option>
            </select>
        </div>

        <!-- Tipo de Ropa -->
        <label for="tipoRopa">Tipo de Ropa:</label>
        <select  class="form-select" name="tipoRopa" id="tipoRopa" required>
            <option value="sabanas">Sábanas</option>
            <option value="almohadas">Almohadas</option>
            <option value="batas">Batas</option>
            <option value="interior">Interior</option>
            <option value="calzado">Calzado</option>
            <option value="toalla">Toalla</option>
            <option value="quirurgica">Quirúrgica</option>
        </select>
    
        <!-- Ubicación -->
        <label for="ubicacion_id">Ubicación:</label>
        <select  class="form-select" name="ubicacion_id" id="ubicacion_id" required>
            @foreach ($ubicaciones as $ubicacion)
            <option value="{{ $ubicacion->id }}">
                {{ $ubicacion->nombre }} {{$ubicacion->tipoArea}} - {{$ubicacion->departamento}} Piso {{ $ubicacion->nivelPiso }}
            </option>
            @endforeach
        </select>
        <button type="submit">Registrar Movimiento</button>
        </div>
    </form>
    




</div>

@endsection
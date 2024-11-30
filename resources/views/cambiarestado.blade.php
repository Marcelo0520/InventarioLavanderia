@extends('layout')

@section('title','Cambiar estado de ropa')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container__form">
    <h2 class="text-center">Cambiar Estado de Ropa</h2>
    <form method="POST" action="{{ route('ropa.changeState') }}">
        @csrf
        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <select class="form-select" id="ubicacion" name="ubicacion_id" required>
                <option value="">Seleccione una ubicación</option>
                @foreach ($ubicaciones as $ubicacion)
                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tipoRopa" class="form-label">Tipo de Ropa</label>
            <select class="form-select" id="tipoRopa" name="tipoRopa" required>
                <option value="">Seleccione un tipo de ropa</option>
                @foreach ($tiposRopa as $tipo)
                    <option value="{{ $tipo }}">{{ $tipo }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="estadoActual" class="form-label">Estado Actual</label>
            <select class="form-select" id="estadoActual" name="estado_actual" required>
                <option value="limpia">Limpia</option>
                <option value="sucia">Sucia</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" required>
        </div>
        <div class="mb-3">
            <label for="nuevoEstado" class="form-label">Nuevo Estado</label>
            <select class="form-select" id="nuevoEstado" name="nuevo_estado" required>
                <option value="limpia">Limpia</option>
                <option value="sucia">Sucia</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cambiar Estado</button>
    </form>
</div>

@endsection
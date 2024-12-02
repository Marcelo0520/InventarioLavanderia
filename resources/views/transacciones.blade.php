@extends('layout')

@section('title','Seguimiento y transacciones')

@section('content')

<div class="container__reporte">
    <h1 class="atractive__title">Seguimiento de los movimientos realizados</h1>
    <form class="search__form" action="{{ route('transacciones.index') }}" method="GET">
        <div class="form-group">
            <label for="ubicacion">Ubicación</label>
            <select name="ubicacion" id="ubicacion" class="form-control">
                <option value="">Seleccione Ubicación</option>
                @foreach ($ubicaciones as $ubicacion)
                    <option value="{{ $ubicacion->id }}" {{ request('ubicacion') == $ubicacion->id ? 'selected' : '' }}>
                        {{ $ubicacion->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <div class="form-group">
            <label for="tipo_ropa">Tipo de Ropa</label>
            <select name="tipo_ropa" id="tipoRopa" class="form-select">
                <option value="">Selecciona un tipo de ropa</option>
                @foreach ($tiposRopa as $ropa)
                    <option value="{{ $ropa->tipo }}" {{ request('tipo_ropa') == $ropa->tipo ? 'selected' : '' }}>
                        {{ ucfirst($ropa->tipo) }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <div class="form-group">
            <label for="fecha_inicio">Fecha</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
        </div>
    
        <div class="form-group">
            <label for="estado">Estado de la Ropa</label>
            <select name="estado" id="estado" class="form-control">
                <option value="">Seleccione Estado</option>
                <option value="limpia" {{ request('estado') == 'limpia' ? 'selected' : '' }}>Limpia</option>
                <option value="sucia" {{ request('estado') == 'sucia' ? 'selected' : '' }}>Sucia</option>
            </select>
        </div>
    
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
    
    @if($movimientos->isEmpty())
        <div class="alert alert-warning mt-4" role="alert">
            No se encontraron movimientos que coincidan con los filtros aplicados.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tipo de Movimiento</th>
                    <th>Tipo de ropa</th>
                    <th>Cantidad</th>
                    <th>Ubicación</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movimientos as $movimiento)
                    <tr>
                        <td>{{ $movimiento->tipoMov }}</td>
                        <td>{{ $movimiento->tipoRopa}}</td>
                        <td>{{ $movimiento->cantidad }}</td>
                        <td>{{ $movimiento->ubicacion->nombre}} - {{ $movimiento->ubicacion->departamento}}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($movimiento->fecha)->format('d-m-Y') }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($movimiento->fecha)->format('H:i:s') }}
                        </td>
                        <td>{{ $movimiento->estado }}</td>
                        <td>{{ $movimiento->usuario->username ?? 'No asignado' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $movimientos->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@endsection

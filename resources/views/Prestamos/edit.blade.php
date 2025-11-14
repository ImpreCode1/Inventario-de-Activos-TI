@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <center>
        <h1>Editar Préstamo</h1>
    </center>
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        <div class="card">
            <div class="card-body">

                <form action="{{ route('prestamos.update', $prestamo->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Ítem --}}
                    <div class="mb-3">
                        <label class="form-label">Ítem prestado</label>
                        <input
                            type="text"
                            name="item_nombre"
                            class="form-control"
                            style="width:450px;"
                            value="{{ old('item_nombre', $prestamo->item_nombre) }}"
                            placeholder="Ej: Mouse Logitech, Cable HDMI"
                            required
                        >
                    </div>

                    {{-- Usuario receptor --}}
                    <div class="mb-3">
                        <label class="form-label">Usuario que recibe</label>
                        <select name="usuario_id" class="form-control" style="width:450px;" required>
                            <option value="">Seleccione...</option>

                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}"
                                    {{ $prestamo->usuario_id == $empleado->id ? 'selected' : '' }}>
                                    {{ $empleado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Fecha préstamo --}}
                    <div class="mb-3">
                        <label class="form-label">Fecha del préstamo</label>
                        <input
                            type="date"
                            name="fecha_prestamo"
                            class="form-control"
                            style="width:450px;"
                            value="{{ old('fecha_prestamo', \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('Y-m-d')) }}"
                            required
                        >
                    </div>

                    

                    <a href="{{ route('prestamos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>

                </form>

            </div>
        </div>

    </div>
</div>
@stop

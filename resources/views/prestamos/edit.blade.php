@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/vendor/select2/css/select2.min.css">

    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>
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
                            <input type="text" name="item_nombre" class="form-control"
                                value="{{ old('item_nombre', $prestamo->item_nombre) }}"
                                placeholder="Ej: Mouse Logitech, Cable HDMI" required>
                        </div>

                        {{-- Usuario receptor --}}
                        <div class="mb-3">
                            <label class="form-label">Usuario que recibe</label>
                            <select name="usuario_id" id="usuario_id" class="form-control" required>
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
                            <input type="date" name="fecha_prestamo" class="form-control"
                                value="{{ old('fecha_prestamo', \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('Y-m-d')) }}"
                                required>
                        </div>

                        {{-- Estado --}}
                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-control" required>
                                <option value="Prestado"
                                    {{ old('estado', $prestamo->estado) == 'Prestado' ? 'selected' : '' }}>
                                    Prestado
                                </option>
                                <option value="Perdido"
                                    {{ old('estado', $prestamo->estado) == 'Perdido' ? 'selected' : '' }}>
                                    Perdido
                                </option>
                            </select>
                            @error('estado')
                                <small class="text-danger">Error: {{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Observaciones --}}
                        <div class="mb-3">
                            <label class="form-label">Observaciones</label>
                            <textarea name="observaciones" class="form-control" rows="3"
                                placeholder="Ej: El mouse tiene un rayón, el cable es de 2m, etc.">{{ old('observaciones', $prestamo->observaciones) }}</textarea>
                            @error('observaciones')
                                <small class="text-danger">Error: {{ $message }}</small>
                            @enderror
                        </div>

                        <a href="{{ route('prestamos.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar</button>

                    </form>

                </div>
            </div>

        </div>
    </div>
@stop

@section('js')
    <script src="/vendor/select2/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializar Select2
            $('#usuario_id').select2({
                placeholder: "Buscar empleado...",
                allowClear: true,
                width: "100%"
            });

            $('#usuario_id').on('select2:open', function(e) {
                document.querySelector('.select2-search__field').focus();
            });
        });
    </script>
@stop

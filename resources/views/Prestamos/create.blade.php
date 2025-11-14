@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/vendor/select2/css/select2.min.css">
@stop

@section('content_header')
    <center>
        <h1>Registrar Préstamo</h1>
    </center>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('prestamos.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Item prestado</label>
                            <input type="text" name="item_nombre" class="form-control"
                                placeholder="Ej: Cable HDMI, Mouse óptico" required>
                        </div>

                        <div class="form-group">
                            <label for="usuario_id">Prestado a</label>
                            <select name="usuario_id" id="usuario_id" class="form-control" required>
                                <option value="">Seleccione un empleado</option>
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}">
                                        {{ $empleado->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha de préstamo</label>
                            <input type="date" name="fecha_prestamo" class="form-control" value="{{ date('Y-m-d') }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Observaciones</label>
                            <textarea name="observaciones" class="form-control" placeholder="Opcional"></textarea>
                        </div>

                        <a href="{{ route('prestamos.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>

                    </form>

                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <!-- Archivos locales -->
    <script src="/vendor/jquery/jquery-3.5.1.min.js"></script>
    <script src="/vendor/select2/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#usuario_id').select2({
                placeholder: "Buscar empleado...",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@stop

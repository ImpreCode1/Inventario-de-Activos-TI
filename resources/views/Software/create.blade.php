@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/vendor/select2/css/select2.min.css">
@stop

@section('content_header')
    <center><h1>Crear Registro de Responsabilidad de software</h1></center>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="/softwares" method="POST">
                        @csrf
                        <div>
                            <label for="" class="form-label">Empleado</label>
                            <select name="id_empleado" id="id_empleado" class="form-control" tabindex="1"
                                style="width: 450px;" required>
                                <option value="">-- Seleccione el empleado --</option>
                                @foreach ($empleados_ordenados as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <a href="/softwares" class="btn btn-secondary" tabindex="2">Cancelar</a>
                        <button type="submit" class="btn btn-primary" tabindex="3">Guardar</button>
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
            $('#id_empleado').select2({
                placeholder: "-- Seleccione el empleado --",
                allowClear: true,
                width: "100%"
            });

            $('#id_empleado').on('select2:open', function(e) {
                document.querySelector('.select2-search__field').focus();
            });
        });
    </script>
@stop
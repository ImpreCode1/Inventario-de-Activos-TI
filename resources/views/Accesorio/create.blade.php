@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/vendor/select2/css/select2.min.css">
@stop

@section('content_header')
   <center> <h1>Crear nuevo Accesorio</h1></center>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="/accesorios" method="POST">
                        @csrf
                        <div>
                            <label for="" class="form-label">Categoria<span style="color:red">*</span></label>
                            <select name="id_categoria" id="id_categoria" class="form-control" tabindex="1" required>
                                <option value="">-- Seleccione la categoria del accesorio --</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Marca<span style="color:red">*</span></label>
                            <select name="id_marca" id="id_marca" class="form-control" tabindex="2" required>
                                <option value="">-- Escoja la marca del accesorio --</option>
                                @foreach ($marcas_ordenadas as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Escriba el Modelo del accesorio<span style="color:red">*</span></label>
                            <input type="text" name="serie" id="serie" class="form-control"
                                placeholder="Modelo" tabindex="3" required>
                        </div>
                        <div>
                            <label for="" class="form-label">Serial del Accesorio<span style="color:red">*</span></label>
                            <input type="text" name="n_serial" id="n_serial" class="form-control" placeholder="XXXX-XXXX-XXXX"
                                tabindex="5" required>
                        </div>
                        <div>
                            <label for="" class="form-label">Numero de parte<span style="color:red">*</span></label>
                            <input type="text" name="n_parte" id="n_parte" class="form-control"
                                placeholder="Numero de parte" tabindex="6" required>
                        </div>
                        <div>
                            <label for="" class="form-label">Observaciones acerca del Accesorio</label>
                            <input type="text" name="observaciones" id="observaciones" class="form-control"
                                placeholder="Observaciones" tabindex="7">
                        </div>
                        <div>
                            <label for="" class="form-label">Empleado al que se le asigna<span style="color:red">*</span></label>
                            <select name="id_empleado" id="id_empleado" class="form-control" tabindex="8" required>
                                <option value="">-- Escoja el empleado al que pertenecera el equipo --</option>
                                @foreach ($empleados_ordenados as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <a href="/accesorios" class="btn btn-secondary" tabindex="9">Cancelar</a>
                        <button type="submit" class="btn btn-primary" tabindex="10">Guardar</button>
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
                placeholder: "-- Escoja el empleado al que pertenecera el accesorio --",
                allowClear: true,
                width: "100%"
            });

            $('#id_empleado').on('select2:open', function(e) {
                document.querySelector('.select2-search__field').focus();
            });
        });
    </script>
@stop
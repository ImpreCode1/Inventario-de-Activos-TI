@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/vendor/select2/css/select2.min.css">
@stop

@section('content_header')
   <center> <h1>Editar Accesorio</h1></center>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="/accesorios/{{ $accesorio->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="" class="form-label">Categoria</label>
                            <select name="id_categoria" id="id_categoria" class="form-control" tabindex="1">
                                <option value="">-- Seleccione la categoria del accesorio --</option>
                                @foreach ($categoria as $categoria)
                                    <option value="{{ $categoria->id }}" @if(old('id_categoria', $accesorio->id_categoria ?? 'No existe') == $categoria->id) selected @endif>{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Marca</label>
                            <select name="id_marca" id="id_marca" class="form-control" tabindex="2">
                                <option value="">-- Escoja la marca del accesorio --</option>
                                @foreach ($marca as $marca)
                                    <option value="{{ $marca->id }}" @if(old('id_categoria', $accesorio->id_marca ?? 'No existe') == $marca->id) selected @endif>{{ $marca->marca }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Escriba la serie o modelo del accesorio</label>
                            <input type="text" name="serie" id="serie" class="form-control" placeholder="Serie o Modelo"
                                value="{{ $accesorio->serie ?? 'No existe' }}" tabindex="3">
                        </div>
                        <div>
                            <label for="" class="form-label">Serial del accesorio</label>
                            <input type="text" name="n_serial" id="n_serial" class="form-control" placeholder="XXXX-XXXX-XXXX"
                                value="{{ $accesorio->n_serial ?? 'No existe' }}" tabindex="5">
                        </div>
                        <div>
                            <label for="" class="form-label">Numero de parte</label>
                            <input type="text" name="n_parte" id="n_parte" class="form-control"
                                placeholder="Numero de parte" value="{{ $accesorio->n_parte ?? 'No existe' }}"
                                tabindex="6">
                        </div>
                        <div>
                            <label for="" class="form-label">Observaciones acerca del accesorio</label>
                            <input type="text" name="observaciones" id="observaciones" class="form-control"
                                placeholder="Observaciones" value="{{ $accesorio->observaciones ?? 'No existe' }}"
                                tabindex="7">
                        </div>
                        <div>
                            <label for="" class="form-label">Nuevo empleado al que se le Asigna</label>
                            <select name="id_empleado" id="id_empleado" class="form-control" tabindex="8"
                                value="{{ $accesorio->id_empleado ?? 'No existe' }}">
                                <option value="">-- Escoja el empleado al que pertenecera el accesorio --</option>
                                @foreach ($empleado as $empleado)
                                <option value="{{ $empleado->id }}" @if(old('id_categoria', $accesorio->id_empleado ?? 'No existe') == $empleado->id) selected @endif>{{ $empleado->nombre }}</option>
                            @endforeach
                            </select>
                        </div>
                        <br>
                        <a href="/equipos" class="btn btn-secondary" tabindex="9">Cancelar</a>
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
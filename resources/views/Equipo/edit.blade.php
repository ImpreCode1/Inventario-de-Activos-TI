@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <center>
        <h1>Editar Equipo</h1>
    </center>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="/equipos/{{ $equipo->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="" class="form-label">Categoria</label>
                            <select name="id_categoria" id="id_categoria" class="form-control" tabindex="1">
                                <option value="">-- Seleccione la categoria del equipo --</option>
                                @foreach ($categoria as $categoria)
                                    <option value="{{ $categoria->id }}" @if(old('id_categoria', $equipo->id_categoria) == $categoria->id) selected @endif>{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Marca</label>
                            <select name="id_marca" id="id_marca" class="form-control" tabindex="2">
                                <option value="">-- Escoja la marca del equipo --</option>
                                @foreach ($marca as $marca)
                                    <option value="{{ $marca->id }}" @if(old('id_marca', $equipo->id_marca) == $marca->id) selected @endif>{{ $marca->marca }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Escriba la serie del equipo</label>
                            <input type="text" name="serie" id="serie" class="form-control" placeholder="serie"
                                value="{{ $equipo->serie ?? 'No existe' }}" tabindex="3">
                        </div>
                        <div>
                            <label for="" class="form-label">Numero de Activo</label>
                            <input type="text" name="n_activo" id="n_activo" class="form-control"
                                placeholder="Numero de Activo" value="{{ $equipo->n_activo ?? 'No existe' }}"
                                tabindex="4">
                        </div>
                        <div>
                            <label for="" class="form-label">Serial del equipo</label>
                            <input type="text" name="n_serial" id="n_serial" class="form-control" placeholder="Serial"
                                value="{{ $equipo->n_serial ?? 'No existe' }}" tabindex="5">
                        </div>
                        <div>
                            <label for="" class="form-label">Numero de parte</label>
                            <input type="text" name="n_parte" id="n_parte" class="form-control"
                                placeholder="Numero de parte" value="{{ $equipo->n_parte ?? 'No existe' }}" tabindex="6">
                        </div>
                        <div>
                            <label for="" class="form-label">Memoria Ram</label>
                            <input type="text" name="memoria_ram" id="memoria_ram" class="form-control"
                                placeholder="memoria_ram" value="{{ $equipo->memoria_ram ?? 'No existe' }}" tabindex="7">
                        </div>
                        <div>
                            <label for="" class="form-label">Procesador</label>
                            <input type="text" name="procesador" id="procesador" class="form-control"
                                placeholder="Procesador" value="{{ $equipo->procesador ?? 'No existe' }}" tabindex="8">
                        </div>
                        <div>
                            <label for="" class="form-label">Discoduro</label>
                            <input type="text" name="discoduro" id="discoduro" class="form-control"
                                placeholder="Discoduro" value="{{ $equipo->discoduro ?? 'No existe' }}" tabindex="9">
                        </div>
                        <div>
                            <label for="" class="form-label">Observaciones acerca del equipo</label>
                            <input type="text" name="observaciones" id="observaciones" class="form-control"
                                placeholder="Observaciones" value="{{ $equipo->observaciones ?? 'No existe' }}"
                                tabindex="10">
                        </div>
                        <div>
                            <label for="" class="form-label">Empleado al que se le asigna</label>
                            <select name="id_empleado" id="id_empleado" class="form-control" tabindex="11">
                                <option value="">-- Escoja el empleado al que pertenecerá el equipo --</option>
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}" @if(old('id_marca', $equipo->id_empleado) == $empleado->id) selected @endif>{{ $empleado->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Nombre del equipo</label>
                            <input type="text" name="nom_equipo" id="nom_equipo" class="form-control"
                                placeholder="Nombre del equipo" value="{{ $equipo->nom_equipo ?? 'No existe' }}"
                                tabindex="12">
                        </div>
                        <br>
                        <a href="/equipos" class="btn btn-secondary" tabindex="13">Cancelar</a>
                        <button type="submit" class="btn btn-primary" tabindex="14">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

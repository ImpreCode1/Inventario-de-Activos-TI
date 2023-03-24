@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <center>
        <h1>Crear nuevo Equipo</h1>
    </center>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="/equipos" method="POST">
                        @csrf
                        <div>
                            <label for="" class="form-label">Categoria</label>
                            <select name="id_categoria" id="id_categoria" class="form-control" tabindex="1">
                                <option value="">-- Seleccione la categoria del equipo --</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Marca</label>
                            <select name="id_marca" id="id_marca" class="form-control" tabindex="2">
                                <option value="">-- Escoja la marca del equipo --</option>
                                @foreach ($marcas_ordenadas as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Escriba el Modelo del equipo</label>
                            <input type="text" name="serie" id="serie" class="form-control" placeholder="serie"
                                tabindex="3">
                        </div>
                        <div>
                            <label for="" class="form-label">Numero de Activo</label>
                            <input type="text" name="n_activo" id="n_activo" class="form-control"
                                placeholder="Numero de Activo" tabindex="4">
                        </div>
                        <div>
                            <label for="" class="form-label">Serial del equipo</label>
                            <input type="text" name="n_serial" id="n_serial" class="form-control" placeholder="Serial"
                                tabindex="5">
                        </div>
                        <div>
                            <label for="" class="form-label">Numero de parte</label>
                            <input type="text" name="n_parte" id="n_parte" class="form-control"
                                placeholder="Numero de parte" tabindex="6">
                        </div>
                        <div>
                            <label for="" class="form-label">Memoria Ram</label>
                            <input type="text" name="memoria_ram" id="memoria_ram" class="form-control"
                                placeholder="Memoria Ram" tabindex="7">
                        </div>
                        <div>
                            <label for="" class="form-label">Procesador</label>
                            <input type="text" name="procesador" id="procesador" class="form-control"
                                placeholder="Procesador" tabindex="8">
                        </div>
                        <div>
                            <label for="" class="form-label">Discoduro</label>
                            <input type="text" name="discoduro" id="discoduro" class="form-control"
                                placeholder="Discoduro" tabindex="9">
                        </div>
                        <div>
                            <label for="" class="form-label">Observaciones acerca del equipo</label>
                            <input type="text" name="observaciones" id="observaciones" class="form-control"
                                placeholder="Observaciones" tabindex="10">
                        </div>
                        <div>
                            <label for="" class="form-label">Empleado al que se le asigna</label>
                            <select name="id_empleado" id="id_empleado" class="form-control" tabindex="11">
                                <option value="">-- Escoja el empleado al que pertenecera el equipo --</option>
                                @foreach ($empleados_ordenados as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Nombre del equipo</label>
                            <input type="text" name="nom_equipo" id="nom_equipo" class="form-control"
                                placeholder="Nombre del equipo" tabindex="12">
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

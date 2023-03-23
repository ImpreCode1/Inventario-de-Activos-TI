@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <h1>Crear Empleado</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/empleados" method="POST">
                @csrf
                <div>
                    <label for="" class="form-label">Nombre del empleado</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre"
                        tabindex="1">
                </div>
                <div>
                    <label for="" class="form-label">Cargo</label>
                    <select name="id_cargo" id="id_cargo"  class="form-control" tabindex="2">
                        <option value="">-- Escoja el cargo al que pertenecera el empleado --</option>
                        @foreach ($cargos_ordenados as $id => $nombre)
                            <option value="{{$id}}">{{$nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="" class="form-label">Departamento</label>
                    <select name="id_depto" id="id_depto"  class="form-control" tabindex="3">
                    <option value="">-- Escoja el Departamento al que pertenecera el empleado --</option>
                    @foreach ($departamentos_ordenados as $id => $nombre)
                        <option value="{{$id}}">{{$nombre}}</option>
                    @endforeach
                </select>
                </div>
                <div>
                    <label for="" class="form-label">Numero de Extencion</label>
                    <input type="text" name="num_exten" id="num_exten" class="form-control" placeholder="Numero"
                        tabindex="5">
                </div>
                <div>
                    <label for="" class="form-label">Estado del empleado</label>
                    <select name="retirado" id="retirado" class="form-control" tabindex="6">
                        <option value="">-- Seleccione si esta retirado el empleado o no --</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
                <div>
                    <label for="" class="form-label">Usuario de dominio</label>
                    <input type="text" name="usu_dominio" id="usu_dominio" class="form-control" placeholder="Usuario de dominio"
                        tabindex="7">
                </div>
                <div>
                    <label for="" class="form-label">Modo de Usuario</label>
                    <select name="id_modo_usuario" id="id_modo_usuario"  class="form-control" tabindex="9">
                        <option value="">-- Modo Usuario del empleado --</option>
                        @foreach ($modoUsuarios as $modoUsuario)
                            <option value="{{$modoUsuario['id']}}">{{$modoUsuario['cargo']}}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <a href="/empleados" class="btn btn-secondary" tabindex="10">Cancelar</a>
                <button type="submit" class="btn btn-primary" tabindex="11">Guardar</button>
            </form>
        </div>
    </div>


@stop


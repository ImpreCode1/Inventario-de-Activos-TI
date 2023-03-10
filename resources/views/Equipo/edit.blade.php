@extends('adminlte::page')


@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <h1>Editar Empleado</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/equipos/{{$equipo->id}}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="" class="form-label">Categoria</label>
                    <select name="id_categoria" id="id_categoria"  class="form-control" tabindex="1" value="{{$equipo->id_categoria}}">
                        <option value="">-- Seleccione la categoria del equipo --</option>
                        @foreach ($categoria as $categoria)
                            <option value="{{$categoria['id']}}">{{$categoria['nombre']}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="" class="form-label">Marca</label>
                    <select name="id_marca" id="id_marca"  class="form-control" tabindex="2" value="{{$equipo->id_marca}}">
                        <option value="">-- Escoja la marca del equipo --</option>
                        @foreach ($marca as $marca)
                            <option value="{{$marca['id']}}">{{$marca['marca']}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="" class="form-label">Escriba la serie del equipo</label>
                    <input type="text" name="serie" id="serie" class="form-control" placeholder="serie" value="{{$equipo->serie}}"
                        tabindex="3">
                </div>
                <div>
                    <label for="" class="form-label">Numero de Activo</label>
                    <input type="text" name="n_activo" id="n_activo" class="form-control" placeholder="Numero de Activo" value="{{$equipo->n_activo}}"
                        tabindex="4">
                </div>
                <div>
                    <label for="" class="form-label">Serial del equipo</label>
                    <input type="text" name="n_serial" id="n_serial" class="form-control" placeholder="Serial" value="{{$equipo->n_serial}}"
                        tabindex="5">
                </div>
                <div>
                    <label for="" class="form-label">Numero de parte</label>
                    <input type="text" name="n_parte" id="n_parte" class="form-control" placeholder="Numero de parte" value="{{$equipo->n_parte}}"
                        tabindex="6">
                </div>
                <div>
                    <label for="" class="form-label">Memoria Ram</label>
                    <input type="text" name="memoria_ram" id="memoria_ram" class="form-control" placeholder="memoria_ram" value="{{$equipo->memoria_ram}}"
                        tabindex="7">
                </div>
                <div>
                    <label for="" class="form-label">Procesador</label>
                    <input type="text" name="procesador" id="procesador" class="form-control" placeholder="Procesador" value="{{$equipo->procesador}}"
                        tabindex="8">
                </div>
                <div>
                    <label for="" class="form-label">Discoduro</label>
                    <input type="text" name="discoduro" id="discoduro" class="form-control" placeholder="Discoduro" value="{{$equipo->discoduro}}"
                        tabindex="9">
                </div>
                <div>
                    <label for="" class="form-label">Observaciones hacerca del equipo</label>
                    <input type="text" name="observaciones" id="observaciones" class="form-control" placeholder="Observaciones" value="{{$equipo->observaciones}}"
                        tabindex="10">
                </div>
                <div>
                    <label for="" class="form-label">Empleado al que se le asigna</label>
                    <select name="id_empleado" id="id_empleado"  class="form-control" tabindex="11" value="{{$equipo->id_empleado}}">
                        <option value="">-- Escoja el empleado al que pertenecera el equipo --</option>
                        @foreach ($empleado as $empleado)
                            <option value="{{$empleado['id']}}">{{$empleado['nombre']}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="" class="form-label">Nombre del equipo</label>
                    <input type="text" name="nom_equipo" id="nom_equipo" class="form-control" placeholder="Nombre del equipo" value="{{$equipo->nom_equipo}}"
                        tabindex="12">
                </div>
                <br>
                <a href="/equipos" class="btn btn-secondary" tabindex="13">Cancelar</a>
                <button type="submit" class="btn btn-primary" tabindex="14">Guardar</button>
            </form>
        </div>
    </div>
@stop
@extends('adminlte::page')


@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <h1>Editar Celular</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/equipos/{{$celular->id}}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="" class="form-label">Categoria</label>
                    <select name="id_categoria" id="id_categoria"  class="form-control" tabindex="1" value="{{$celular->id_categoria}}">
                        <option value="">-- Seleccione la categoria del equipo --</option>
                        @foreach ($categoria as $categoria)
                            <option value="{{$categoria['id']}}">{{$categoria['nombre']}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="" class="form-label">Marca</label>
                    <select name="id_marca" id="id_marca"  class="form-control" tabindex="2" value="{{$celular->id_marca}}">
                        <option value="">-- Escoja la marca del equipo --</option>
                        @foreach ($marca as $marca)
                            <option value="{{$marca['id']}}">{{$marca['marca']}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="" class="form-label">Escriba el modelo del celular</label>
                    <input type="text" name="modelo" id="modelo" class="form-control" placeholder="serie" value="{{$celular->modelo}}"
                        tabindex="3">
                </div>
                <div>
                    <label for="" class="form-label">Numero de de telefono</label>
                    <input type="text" name="n_telefono" id="n_telefono" class="form-control" placeholder="Numero de Activo" value="{{$celular->n_telefono}}"
                        tabindex="4">
                </div>
                <div>
                    <label for="" class="form-label">Email 1</label>
                    <input type="text" name="email_1" id="email_1" class="form-control" placeholder="Serial" value="{{$celular->email_1}}"
                        tabindex="5">
                </div>
                <div>
                    <label for="" class="form-label">Email 2</label>
                    <input type="text" name="Email 2" id="Email 2" class="form-control" placeholder="Numero de parte" value="{{$celular->email_2}}"
                        tabindex="6">
                </div>
                <div>
                    <label for="" class="form-label">Serial SIM</label>
                    <input type="text" name="serial_sim" id="serial_sim" class="form-control" placeholder="serial_sim" value="{{$celular->serial_sim}}"
                        tabindex="7">
                </div>
                <div>
                    <label for="" class="form-label">Memoria RAM</label>
                    <input type="text" name="ram" id="ram" class="form-control" placeholder="Procesador" value="{{$celular->ram}}"
                        tabindex="8">
                </div>
                <div>
                    <label for="" class="form-label">Almacenamiento</label>
                    <input type="text" name="rom" id="rom" class="form-control" placeholder="Almacenamiento" value="{{$celular->rom}}"
                        tabindex="9">
                </div>
                <div>
                    <label for="" class="form-label">Observaciones acerca del celular</label>
                    <input type="text" name="observaciones" id="observaciones" class="form-control" placeholder="Observaciones" value="{{$celular->observaciones}}"
                        tabindex="10">
                </div>
                <div>
                    <label for="" class="form-label">Empleado al que se le asigna</label>
                    <select name="id_empleado" id="id_empleado"  class="form-control" tabindex="11" value="{{$celular->id_empleado}}">
                        <option value="">-- Escoja el empleado al que pertenecera el equipo --</option>
                        @foreach ($empleado as $empleado)
                            <option value="{{$empleado['id']}}">{{$empleado['nombre']}}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <a href="/equipos" class="btn btn-secondary" tabindex="13">Cancelar</a>
                <button type="submit" class="btn btn-primary" tabindex="14">Guardar</button>
            </form>
        </div>
    </div>
@stop
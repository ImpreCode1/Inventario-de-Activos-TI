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
            <form action="/empleados/{{$empleado->id}}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="" class="form-label">Nombre del empleado</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{$empleado->nombre}}" placeholder="Nombre" tabindex="1" >
                </div>
                <div>
                    <label for="" class="form-label">Cargo</label>
                    <select name="id_cargo" id="id_cargo"  class="form-control" tabindex="2" value="{{$empleado->id_cargo}}">
                        <option value="">-- Escoja el nuevo cargo al que pertenecera el empleado --</option>
                        @foreach ($cargo as $cargo)
                            <option value="{{$cargo['id']}}">{{$cargo['cargo']}}</option>
                        @endforeach  
                    </select>
                </div>
                <div>
                    <label for="" class="form-label">Departamento</label>
                    <select name="id_depto" id="id_depto"  class="form-control" tabindex="3" value="{{$empleado->id_depto}}">
                        <option value="">-- Escoja el nuevo departamento al que pertenecera el empleado --</option>
                        @foreach ($departamento as $departamento)
                            <option value="{{$departamento['id']}}">{{$departamento['nombre']}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="" class="form-label">Clave del telefono</label>
                    <input type="text" name="clave_tel" id="clave_tel" class="form-control" value="{{$empleado->clave_tel}}" placeholder="Clave del telefono" tabindex="4" value="">
                </div>
                <div>
                    <label for="" class="form-label">Numero de Extencion</label>
                    <input type="text" name="num_exten" id="num_exten" class="form-control" value="{{$empleado->num_exten}}" placeholder="Numero de Extencion" tabindex="5" value="">
                </div>
                <div>
                    <label for="" class="form-label">Estado del empleado</label>
                    <select name="retirado" id="retirado" class="form-control" tabindex="6" value="{{$empleado->retirado}}">
                        <option value="">-- Seleccione si esta retirado el empleado o no --</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
                <div>
                    <label for="" class="form-label">Usuario de dominio</label>
                    <input type="text" name="usu_dominio" id="usu_dominio" class="form-control" value="{{$empleado->usu_dominio}}" placeholder="Usuario de dominio" tabindex="7" value="">
                </div>
                <div>
                    <label for="" class="form-label">Clave de dominio</label>
                    <input type="text" name="clave_dominio" id="clave_dominio" class="form-control" value="{{$empleado->clave_dominio}}" placeholder="Clave de dominio" tabindex="8" value="">
                </div>
                <div>
                    <label for="" class="form-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{$empleado->email}}" placeholder="Email" tabindex="9" value="">
                </div>
                <div>
                <div>
                    <label for="" class="form-label">Modo de Usuario</label>
                    <select name="id_modo_usuario" id="id_modo_usuario"  class="form-control" tabindex="12" value="{{$empleado->id_modo_usuario}}">
                        <option value="">-- Modo Usuario del empleado --</option>
                        @foreach ($modoUsuario as $modoUsuario)
                            <option value="{{$modoUsuario['id']}}">{{$modoUsuario['cargo']}}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <a href="/empleados" class="btn btn-secondary" tabindex="13">Cancelar</a>
                <button type="submit" class="btn btn-primary" tabindex="14">Guardar</button>
            </form>
        </div>
    </div>
@stop
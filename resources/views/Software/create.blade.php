@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <h1>Crear Registro de Responsabilidad de software</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/softwares" method="POST">
                @csrf
                <div>
                    <label for="" class="form-label">Empleado</label>
                    <select name="id_empleado" id="id_empleado"  class="form-control" tabindex="1">
                        <option value="">-- Seleccione el empleado --</option>
                        @foreach ($empleados as $empleado)
                            <option value="{{$empleado['id']}}">{{$empleado['nombre']}}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <a href="/softwar" class="btn btn-secondary" tabindex="2">Cancelar</a>
                <button type="submit" class="btn btn-primary" tabindex="3">Guardar</button>
            </form>
        </div>
    </div>
@stop


@extends('adminlte::page')


@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <h1>Actualizar Departamento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/departamentos/{{$departamento->id}}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="" class="form-label">Departamento</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{$departamento->nombre}}" placeholder="Departamento" tabindex="1" >
                </div>
                <br>
                <a href="/departamentos" class="btn btn-secondary" tabindex="2">Cancelar</a>
                <button type="submit" class="btn btn-primary" tabindex="3">Guardar</button>
            </form>
        </div>
    </div>
@stop

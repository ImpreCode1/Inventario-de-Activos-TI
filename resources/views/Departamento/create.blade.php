@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <h1>Crear Departamento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/departamentos" method="POST">
                @csrf
                <div>
                    <label for="" class="form-label">Nombre del departamento</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Departamento"
                        tabindex="1">
                </div>
                <br>
                <a href="/cargos" class="btn btn-secondary" tabindex="2">Cancelar</a>
                <button type="submit" class="btn btn-primary" tabindex="3">Guardar</button>
            </form>
        </div>
    </div>
@stop


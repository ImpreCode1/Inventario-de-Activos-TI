@extends('adminlte::page')


@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <h1>Editar Cargo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/cargos/{{$cargo->id}}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="" class="form-label">Cargo</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{$cargo->cargo}}" placeholder="Cargo" tabindex="1" >
                </div>
                <div>
                    <label for="" class="form-label">Detalle</label>
                    <input type="text" name="detalle" id="detalle" class="form-control" value="{{$cargo->detalle}}" placeholder="Detalle" tabindex="2">
                </div>
                <br>
                <a href="/cargos" class="btn btn-secondary" tabindex="3">Cancelar</a>
                <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
            </form>
        </div>
    </div>
@stop


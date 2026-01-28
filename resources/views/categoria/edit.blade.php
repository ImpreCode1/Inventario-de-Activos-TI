@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <center>
        <h1>Editar Categoría</h1>
    </center>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="/categorias/{{ $categoria->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="nombre" class="form-label">Categoria</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" style="width: 450px;"
                                value="{{ $categoria->nombre ?? 'No existe' }}" placeholder="Categoria" tabindex="1">
                        </div>
                        <br>
                        <a href="/categorias" class="btn btn-secondary" tabindex="3">Cancelar</a>
                        <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

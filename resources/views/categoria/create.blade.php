@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <center><h1>Crear Categoría</h1></center>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="/categorias" method="POST">
                        @csrf
                        <div>
                            <label for="nombre" class="form-label">Registre la nueva Marca</label>
                            <input type="text" name="nombre" id="mnombre" class="form-control" style="width:450px;"
                                placeholder="Categoría" tabindex="1" required>
                        </div>
                        <br>
                        <a href="/categorias" class="btn btn-secondary" tabindex="2">Cancelar</a>
                        <button type="submit" class="btn btn-primary" tabindex="3">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

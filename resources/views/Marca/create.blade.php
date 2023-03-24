@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <center><h1>Crear Marca</h1></center>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="/marcas" method="POST">
                        @csrf
                        <div>
                            <label for="" class="form-label">Registre la nueva Marca</label>
                            <input type="text" name="marca" id="marca" class="form-control" style="width:450px;"
                                placeholder="Marca" tabindex="1">
                        </div>
                        <br>
                        <a href="/marcas" class="btn btn-secondary" tabindex="2">Cancelar</a>
                        <button type="submit" class="btn btn-primary" tabindex="3">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

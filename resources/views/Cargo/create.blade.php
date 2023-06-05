@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
   <center> <h1>Crear Cargo</h1></center>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="/cargos" method="POST">
                        @csrf
                        <div>
                            <label for="" class="form-label">Cargo</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Escriba el Cargo"
                                tabindex="1" required>
                        </div>
                        <div>
                            <label for="" class="form-label">Detalle</label>
                            <input type="text" name="detalle" id="detalle" class="form-control" placeholder="Escriba el Detalle"
                                tabindex="2" >
                        </div>
                        <br>
                        <a href="/cargos" class="btn btn-secondary" tabindex="3">Cancelar</a>
                        <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

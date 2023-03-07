@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@stop

@section('content_header')
    <h1>Crear Cargo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/cargos" method="POST">
                @csrf
                <div>
                    <label for="" class="form-label">Cargo</label>
                    <input type="text" name="cargo" id="cargo" class="form-control" placeholder="Cargo"
                        tabindex="1">
                </div>
                <div>
                    <label for="" class="form-label">Detalle</label>
                    <input type="text" name="detalle" id="detalle" class="form-control" placeholder="Detalle"
                        tabindex="2">
                </div>
                <br>
                <a href="/cargos" class="btn btn-secondary" tabindex="3">Cancelar</a>
                <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
            </form>
        </div>
    </div>


@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@stop

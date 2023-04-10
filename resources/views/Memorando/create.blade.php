@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <center><h1>Crear Memorando</h1></center>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="/memorandos" method="POST">
                        @csrf
                        <div>
                            <label for="" class="form-label">Empleado</label>
                            <select name="id_empleado" id="id_empleado" class="form-control" tabindex="1">
                                <option value="">-- Seleccione el empleado --</option>
                                @foreach ($empleados_ordenados as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Ciudad</label>
                            <input type="text" name="ciudad" id="ciudad" class="form-control"
                                placeholder="Ciudad" tabindex="2" required>
                        </div>
                        <div>
                            <label for="" class="form-label">Direccion</label>
                            <input type="text" name="direccion" id="direccion" class="form-control"
                                placeholder="Direccion" tabindex="3" required>
                        </div>
                        <div>
                            <label for="" class="form-label">Numero de contacto</label>
                            <input type="text" name="n_contacto" id="n_contacto" class="form-control"
                                placeholder="Numero de Contacto" tabindex="4" >
                        </div>
                        <div>
                            <label for="" class="form-label">Correo de quien envia el memorando</label>
                            <input type="text" name="correo_encargado" id="correo_encargado" class="form-control"
                                placeholder="Correo del encargado" tabindex="4" required>
                        </div>
                        <br>
                        <a href="/memorandos" class="btn btn-secondary" tabindex="5">Cancelar</a>
                        <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

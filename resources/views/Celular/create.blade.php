@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
  <center>  <h1>Crear un nuevo Celular</h1></center>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="/celulares" method="POST">
                        @csrf
                        <div>
                            <label for="" class="form-label">Categoria</label>
                            <select name="id_categoria" id="id_categoria" class="form-control" tabindex="1">
                                <option value="">-- Seleccione la categoria --</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Marca</label>
                            <select name="id_marca" id="id_marca" class="form-control" tabindex="2">
                                <option value="">-- Escoja la marca del Celular --</option>
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca['id'] }}">{{ $marca['marca'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Escriba el modelo del celular</label>
                            <input type="text" name="modelo" id="modelo" class="form-control"
                                placeholder="Modelo del celular" tabindex="3">
                        </div>
                        <div>
                            <label for="" class="form-label">Numero de de telefono</label>
                            <input type="text" name="n_telefono" id="n_telefono" class="form-control"
                                placeholder="Numero de telefono" tabindex="4">
                        </div>
                        <div>
                            <label for="" class="form-label">IMEI 1</label>
                            <input type="text" name="email_1" id="email_1" class="form-control" placeholder="IMEI 1"
                                tabindex="5">
                        </div>
                        <div>
                            <label for="" class="form-label">IMEI 2</label>
                            <input type="text" name="email_2" id="email_2" class="form-control" placeholder="IMEI 2"
                                tabindex="6">
                        </div>
                        <div>
                            <label for="" class="form-label">Serial SIM</label>
                            <input type="text" name="serial_sim" id="serial_sim" class="form-control"
                                placeholder="Serial SIM" tabindex="7">
                        </div>
                        <div>
                            <label for="" class="form-label">Memoria RAM</label>
                            <input type="text" name="ram" id="ram" class="form-control"
                                placeholder="Memoria RAM" tabindex="8">
                        </div>
                        <div>
                            <label for="" class="form-label">Almacenamiento</label>
                            <input type="text" name="rom" id="rom" class="form-control"
                                placeholder="Almacenamiento" tabindex="9">
                        </div>
                        <div>
                            <label for="" class="form-label">Observaciones acerca del Celular</label>
                            <input type="text" name="observaciones" id="observaciones" class="form-control"
                                placeholder="Observaciones" tabindex="10">
                        </div>
                        <div>
                            <label for="" class="form-label">Empleado al que se le asigna</label>
                            <select name="id_empleado" id="id_empleado" class="form-control" tabindex="11">
                                <option value="">-- Escoja el empleado al que pertenecera el celular --</option>
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado['id'] }}">{{ $empleado['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <a href="/celulares" class="btn btn-secondary" tabindex="12">Cancelar</a>
                        <button type="submit" class="btn btn-primary" tabindex="13">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

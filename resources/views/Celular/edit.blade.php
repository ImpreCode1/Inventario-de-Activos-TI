@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
   <center><h1>Editar Celular</h1></center>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="/celulares/{{ $celular->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="" class="form-label">Categoria</label>
                            <select name="id_categoria" id="id_categoria" class="form-control" tabindex="1">
                                <option value="">-- Seleccione la categoria del equipo --</option>
                                @foreach ($categoria as $categoria)
                                    <option value="{{ $categoria->id }}" @if(old('id_categoria', $celular->id_categoria ?? 'No existe') == $categoria->id) selected @endif>{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Marca</label>
                            <select name="id_marca" id="id_marca" class="form-control" tabindex="2">
                                <option value="">-- Escoja la marca del equipo --</option>
                                @foreach ($marca as $marca)
                                    <option value="{{ $marca->id }}" @if(old('id_marca', $celular->id_marca ?? 'No Existe') == $marca->id) selected @endif>{{ $marca->marca }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Escriba el nuevo serial del celular</label>
                            <input type="text" name="serial" id="serial" class="form-control" placeholder="XXXX-XXXXX-XXXX"
                                value="{{ $celular->serial ?? 'No existe' }}" tabindex="3">
                        </div>
                        <div>
                            <label for="" class="form-label">Escriba el modelo del celular</label>
                            <input type="text" name="modelo" id="modelo" class="form-control" placeholder="serie"
                                value="{{ $celular->modelo ?? 'No existe' }}" tabindex="3">
                        </div>
                        <div>
                            <label for="" class="form-label">Operador</label>
                            <input type="text" name="operador" id="operador" class="form-control"
                                placeholder="serial_sim" value="{{ $celular->operador ?? 'No existe' }}" tabindex="7">
                        </div>
                        <div>
                            <label for="" class="form-label">Serial SIM</label>
                            <input type="text" name="serial_sim" id="serial_sim" class="form-control"
                                placeholder="XXXX-XXXXX-XXXX" value="{{ $celular->serial_sim ?? 'No existe' }}" tabindex="7">
                        </div>
                        <div>
                            <label for="" class="form-label">Numero de de telefono</label>
                            <input type="text" name="n_telefono" id="n_telefono" class="form-control"
                                placeholder="Numero de telefono" value="{{ $celular->n_telefono ?? 'No existe' }}"
                                tabindex="4">
                        </div>
                        <div>
                            <label for="" class="form-label">IMEI 1</label>
                            <input type="text" name="email_1" id="email_1" class="form-control" placeholder="IMEI 1"
                                value="{{ $celular->email_1 ?? 'No existe' }}" tabindex="5">
                        </div>
                        <div>
                            <label for="" class="form-label">IMEI 2</label>
                            <input type="text" name="Email 2" id="Email 2" class="form-control"
                                placeholder="IMEI 2" value="{{ $celular->email_2 ?? 'No existe' }}"
                                tabindex="6">
                        </div>
                        <div>
                            <label for="" class="form-label">Memoria RAM</label>
                            <input type="text" name="ram" id="ram" class="form-control"
                                placeholder="RAM" value="{{ $celular->ram ?? 'No existe' }}" tabindex="8">
                        </div>
                        <div>
                            <label for="" class="form-label">Almacenamiento</label>
                            <input type="text" name="rom" id="rom" class="form-control"
                                placeholder="ROM" value="{{ $celular->rom ?? 'No existe' }}" tabindex="9">
                        </div>
                        <div>
                        <div>
                            <label for="" class="form-label">Empleado al que se le asigna</label>
                            <select name="id_empleado" id="id_empleado" class="form-control" tabindex="11">
                                <option value="">-- Escoja el empleado al que pertenecera el equipo --</option>
                                @foreach ($empleado as $empleado)
                                    <option value="{{ $empleado->id }}" @if(old('id_marca', $celular->id_empleado ?? 'No existe') == $empleado->id) selected @endif>{{ $empleado->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="form-label">Cedula</label>
                            <input type="text" name="cedula" id="cedula" class="form-control"
                                placeholder="Cedula del empleado" value="{{ $celular->rom ?? 'No existe' }}" tabindex="9">
                        </div>
                        <div>
                        <label for="" class="form-label">Observaciones</label>
                        <input type="text" name="observaciones" id="observaciones" class="form-control"
                            placeholder="Observaciones" value="{{ $celular->observaciones ?? 'No existe' }}"
                            tabindex="10">
                    </div>
                        <br>
                        <a href="/celulares" class="btn btn-secondary" tabindex="13">Cancelar</a>
                        <button type="submit" class="btn btn-primary" tabindex="14">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    .list-unstyled {
    list-style: none;
    padding-left: 0;
    }

    .list-unstyled li {
    margin-bottom: 5px;
    }

    .list-unstyled li span {
    margin-left: 5px;
    }

@stop

@section('content_header')
    <center>
        <h1>Crear Rol</h1>
    </center>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                            @foreach ($errors->all() as $error)
                                <span class="badge badge-danger">{{ $error }}</span>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif


                    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="">Nombre del Rol:</label>
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Permisos para este Rol:</label>
                            <ul class="list-unstyled">
                                @foreach ($permission as $value)
                                    <li>
                                        {{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                                        <span>{{ $value->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

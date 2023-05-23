@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">
    @can('crear-usuario')
    <a href="{{route('users.create')}}" class="btn btn-primary">CREAR</a>
    @endcan
    <p></p>
    <table id="users" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-prymary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if(!@empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $rolName)
                            <h5><span>{{$rolName}}</span></h5>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @can('editar-usuario')
                        <a class="btn btn-info" href="{{route('users.edit', $user->id)}}">Editar</a>
                        @endcan
                        
                        @can('borrar-usuario')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline', 'id' => 'form-eliminar-' . $user->id]) !!}
                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger', 'onclick' => 'confirmDelete(' . $user->id . ')']) !!}
                        {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@stop
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
<script>
  function confirmDelete(userId) {
    if (confirm("¿Estás seguro de que quieres eliminar este usuario?")) {
        document.getElementById('form-eliminar-' + userId).submit();
    }
}
    </script>
<script>
  $(document).ready(function () {
    $('#users').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Mostrar la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(Filtrado de  _MAX_ Registros totales)",
            "search":"Buscar",
            "paginate" :{
            "next":"Siguiente",
            "previous":"Anterior"
            }
        }
    });
});
</script>
@stop
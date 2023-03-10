@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Registro de Empleados</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">
    <a href="empleados/create" class="btn btn-primary">CREAR</a>
    <p></p>
    <table id="empleados" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-prymary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Usuario Dominio</th>
                <th scope="col">N° Ext</th>
                <th scope="col">Email</th>
                <th scope="col">Cargo</th>
                <th scope="col">Departamento</th>
                <th>Acciones</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
            <tr>
                <td>{{ $empleado->id }}</td>
                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->usu_dominio }}</td>
                <td>{{ $empleado->num_exten }}</td>
                <td>{{ $empleado->email }}</td>
                <td>{{ $empleado->cargos->cargo ?? 'El cargo no existe'}}</td>
                <td>{{ $empleado->departamentos->nombre ?? 'El departamento no existe' }}</td>
                <td>
                    <form action="{{ route ('empleados.destroy', $empleado->id) }}" method="POST">
                    <a  href="/empleados/{{ $empleado->id }}/edit" class="btn btn-info">Editar</a>
                    
                    @csrf
                    @method('DELETE')
                    <Button type="submit" class="btn btn-danger">Eliminar</Button>
                </form>
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
    $(document).ready(function () {
    $('#empleados').DataTable({
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
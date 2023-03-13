@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Responsabilidades de Software</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">
    <a href="softwares/create" class="btn btn-primary">CREAR</a>
    <p></p>
    <table id="softwar" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-prymary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Empleado</th>
                <th scope="col">Fecha de creacion</th>
                <th>Acciones</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($softwares as $software)
            <tr>
                <td>{{ $software->id }}</td>
                <td>{{ $software->empleado->nombre ?? 'El empleado no existe' }}</td>
                <td>{{ $software->created_at}}</td>
                <td>
                    <form action="{{ route ('softwares.destroy', $software->id) }}" method="POST">
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
    $('#softwar').DataTable({
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
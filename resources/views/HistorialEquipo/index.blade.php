@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Historial Equipos</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">
    <p></p>
    <table id="historialEquipos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-prymary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Empleado</th>
                <th scope="col">N° de activo del Equipo</th>
                <th scope="col">Fecha Asignacion</th>
                <th  scope="col">Fecha Devolucion</th>
                <th>Acciones</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($equiposHistorial as $h)
            <tr>
                <td>{{ $h->id }}</td>
                <td>{{ $h->empleado->nombre ?? 'No existe'}}</td>
                <td>{{ $h->cpuequipo->n_activo ?? 'No existe'}}</td>
                <td>{{ $h->fecha_asignacion ?? 'No existe' }}</td>
                <td>{{ $h->fecha_devolucion ?? 'No existe' }}</td>
                <td>
                    <form action="{{ route ('equiposHistorial.destroy', $h->id) }}" method="POST">
                    <a  href="/equiposHistorial/{{ $h->id }}/edit" class="btn btn-info btn-sm">Editar</a>
                    
                    @csrf
                    @method('DELETE')
                    <Button type="submit" class="btn btn-danger btn-sm">Eliminar</Button>
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
    $('#historialEquipos').DataTable({
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
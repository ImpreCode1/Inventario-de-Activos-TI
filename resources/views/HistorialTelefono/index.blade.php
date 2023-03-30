@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Historial Telefonos</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">
    <p></p>
    <table id="historialTelefonos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-prymary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Empleado</th>
                <th scope="col">Serial</th>
                <th scope="col">Modelo</th>
                <th scope="col">Fecha Asignacion</th>
                <th  scope="col">Fecha Devolucion</th>
                <th>Acciones</th>
                
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($telefonosHistorial as $h)
            <tr>
                <td>{{ $h->id }}</td>
                <td>{{ $h->empleado->nombre ?? 'No existe'}}</td>
                <td>{{ $h->telefono->serial ?? 'No existe'}}</td>
                <td>{{ $h->fecha_asignacion ?? 'No existe' }}</td>
                <td>{{ $h->fecha_devolucion ?? 'No existe' }}</td>
                <td>
                    <form action="{{ route ('telefonosHistorial.destroy', $h->id) }}" method="POST">
                    <a  href="/telefonosHistorial/{{ $h->id }}/edit" class="btn btn-info btn-sm">Editar</a>
                    
                    @csrf
                    @method('DELETE')
                    <Button type="submit" class="btn btn-danger btn-sm">Eliminar</Button>
                </form>
                </td>
            </tr>
            @endforeach --}}
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
    function confirmDelete(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este historial?')) {
            $('#form-eliminar-' + id).submit();
        }
    }
</script>
<script>
    $(document).ready(function () {
    $('#historialTelefonos').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('historialtelefonos.lista') }}",
        columns: [
        {data: 'id'},
        {data: 'empleado.nombre', name: 'empleado.nombre'},
        {data: 'telefono.serial', name:'telefono.serial'},
        {data: 'telefono.modelo', name:'telefono.modelo'},
        {data: 'fecha_asignacion'},
        {data: 'fecha_devolucion'},
        { data: 'action', name: 'acciones', orderable: false, searchable: false },
    ],
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
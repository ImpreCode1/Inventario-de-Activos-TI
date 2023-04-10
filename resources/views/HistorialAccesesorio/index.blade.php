@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Historial Accesesorios</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">
    <p></p>
    <table id="accesesoriosHistorial" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-prymary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Empleado</th>
                <th scope="col">Categoria</th>
                <th scope="col">N° Serial</th>
                <th scope="col">Fecha Asignacion</th>
                <th  scope="col">Fecha Devolucion</th>
                <th>Acciones</th>
                
            </tr>
        </thead>
        <tbody>
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
    $('#accesesoriosHistorial').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('accesesorioshistorial.lista') }}",
        columns: [
        {data: 'id'},
        {data: 'empleado.nombre', name: 'empleado.nombre', defaultContent: ''},
        {data: 'accesesorio.categoria.nombre', name: 'accesesorio.categoria.nombre', defaultContent: ''},
        {data: 'accesesorio.n_serial', name:'accesesorio.n_serial', defaultContent: ''},
        {data: 'fecha_asignacion', defaultContent: ''},
        {data: 'fecha_devolucion', defaultContent: ''},
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
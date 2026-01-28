@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('title', 'Préstamos de Activos')

@section('content_header')
    <h1>Registro de Préstamos</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">
    @can('crear-prestamo')
    <a href="{{ route('prestamos.create') }}" class="btn btn-primary">CREAR</a>
    @endcan
    <p></p>

    <table id="prestamos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="">
            <tr>
                <th>ID</th>
                <th>Ítem</th>
                <th>Usuario</th>
                <th>Fecha Préstamo</th>
                <th>Fecha Devolución</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
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
        if (confirm("¿Estás seguro de que quieres eliminar este préstamo?")) {
            document.getElementById('form-eliminar-' + id).submit();
        }
    }
</script>

<script>
$(document).ready(function () {
    $('#prestamos').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('prestamos.lista') }}",
        lengthMenu: [[25, 50, 100, -1], ['25', '50', '100', 'Todos']],
        order: [[0, 'desc']],
        columns: [
            {data: 'id'},
            {data: 'item_nombre'},
            {data: 'usuario'},
            {data: 'fecha_prestamo'},
            {data: 'fecha_devolucion', defaultContent: ''},
            {data: 'estado'},
            {data: 'action', orderable: false, searchable: false}
        ],
        language: {
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "Nada encontrado",
            info: "Mostrando página _PAGE_ de _PAGES_",
            infoEmpty: "No hay registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                next: "Siguiente",
                previous: "Anterior"
            }
        }
    });
});
</script>
@stop

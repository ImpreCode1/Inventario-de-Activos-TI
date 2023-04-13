@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
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
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
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
        lengthChange: true,
        lengthMenu: [[25, 50, 100, -1], ['25', '50', '100', 'Todos']],
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Reporte de Historial de Accesesorios',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            }
        ],
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
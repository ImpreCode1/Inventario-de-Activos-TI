@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Inventarios de Equipos</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">
    <a href="equipos/create" class="btn btn-primary">CREAR</a>
    <p></p>
    <table id="equipos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-prymary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Categoria</th>
                <th scope="col">Marca</th>
                <th scope="col">Serie</th>
                <th scope="col">Procesador</th>
                <th scope="col">Discoduro</th>
                <th scope="col">Memoria RAM</th>
                <th scope="col">N° de Activo</th>
                <th scope="col">N° de Serial</th>
                <th scope="col">N° de Parte</th>
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
        if (confirm('¿Estás seguro de que deseas eliminar este Equipo?')) {
            $('#form-eliminar-' + id).submit();
        }
    }
</script>
<script>
    $(document).ready(function () {
    $('#equipos').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('equipos.lista') }}",
        lengthChange: true,
        lengthMenu: [[25, 50, 100, -1], ['25', '50', '100', 'Todos']],
        dom: '<"dt-buttons d-flex justify-content-between"B<"ml-3"l>>frtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Reporte de Equipos',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                }
            }
        ],
        columns: [
        {data: 'id'},
        {data: 'empleado.nombre', name: 'empleado.nombre', defaultContent: ''},
        {data: 'categoria.nombre', name:'categoria.nombre', defaultContent: ''},
        {data: 'marca.marca', name:'marca.marca', defaultContent: ''},
        {data: 'serie', visible: false},
        {data: 'procesador', visible: false},
        {data: 'discoduro', visible: false},
        {data: 'memoria_ram', visible: false},
        {data: 'n_activo', defaultContent: ''},
        {data: 'n_serial', defaultContent: ''},
        {data: 'n_parte', visible: false},
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
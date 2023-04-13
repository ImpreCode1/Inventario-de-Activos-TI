@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
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
                <th scope="col">Contraseña</th>
                <th scope="col">N° Ext</th>
                <th scope="col">Email</th>
                <th scope="col">Cargo</th>
                <th scope="col">Departamento</th>
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
        if (confirm('¿Estás seguro de que deseas eliminar este empleado?')) {
            $('#form-eliminar-' + id).submit();
        }
    }
</script>
<script>
    $(document).ready(function () {
    $('#empleados').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('empleados.lista') }}",
        lengthChange: true,
        lengthMenu: [[25, 50, 100, -1], ['25', '50', '100', 'Todos']],
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Reporte de empleados',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            }
        ],
        columns: [
        {data: 'id'},
        {data: 'nombre', defaultContent: ''},
        {data: 'usu_dominio', defaultContent: ''},
        {data: 'clave_dominio', visible: false},
        {data: 'num_exten', defaultContent: ''},
        {data: 'email', defaultContent: ''},
        {data: 'cargos.nombre', name: 'cargos.nombre', defaultContent: ''},
        {data: 'departamentos.nombre', name: 'departamentos.nombre', defaultContent: ''},
        { data: 'acciones', name: 'acciones', orderable: false, searchable: false },
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
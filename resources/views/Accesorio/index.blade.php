@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Inventarios de Accesorios</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">
    <a href="accesorios/create" class="btn btn-primary">CREAR</a>
    <p></p>
    <table id="accesorios" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-prymary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Categoria</th>
                <th scope="col">Marca</th>
                <th scope="col">Serie</th>
                <th scope="col">N° de Serial</th>
                <th scope="col">N° de Parte</th>
                <th scope="col">Observaciones</th>
                <th>Acciones</th>
                
            </tr>
        </thead>
        <tbody>
        {{--     @foreach ($accesorios as $accesorio)
            <tr>
                <td>{{ $accesorio->id }}</td>
                <td>{{ $accesorio->empleado->nombre ?? 'No existe'}}</td>
                <td>{{ $accesorio->categoria->nombre ?? 'No existe'}}</td>
                <td>{{ $accesorio->marca->marca ?? 'No existe'}}</td>
                <td>{{ $accesorio->n_serial ?? 'No existe'}}</td>
                <td>
                    <form action="{{ route ('accesorios.destroy', $accesorio->id) }}" method="POST">
                    <a  href="/accesorios/{{ $accesorio->id }}/edit" class="btn btn-info btn-sm">Editar</a>
                    <a href="/accesorios/{{$accesorio->id}}/pdf" target="_blank" class="btn btn-success btn-sm">Responsabilidad usu</a>
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
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script>
    function confirmDelete(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este accesesorio?')) {
            $('#form-eliminar-' + id).submit();
        }
    }
</script>
<script>
    $(document).ready(function () {
    $('#accesorios').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('accesesorios.lista') }}",
        lengthChange: true,
        lengthMenu: [[25, 50, 100, -1], ['25', '50', '100', 'Todos']],
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Reporte de Accesesorios',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            }
        ],
        columns: [
        {data: 'id'},
        {data: 'empleado.nombre', name: 'empleado.nombre', defaultContent: ''},
        {data: 'categoria.nombre', name:'categoria.nombre', defaultContent: ''},
        {data: 'marca.marca', name:'marca.marca', defaultContent: ''},
        {data: 'serie', defaultContent: ''},
        {data: 'n_serial', defaultContent: ''},
        {data: 'n_parte', visible: false},
        {data: 'observaciones', visible: false},
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
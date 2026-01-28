@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Registro de Categorias</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">
    @can('ver-categoria')
    <a href="categorias/create" class="btn btn-primary">CREAR</a>
    @endcan
    <p></p>
    <table id="categorias" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-prymary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Categoria</th>
                <th>Acciones</th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
</div>
@stop



@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>

<script>
    function confirmDelete(categoriaId) {
        if (confirm("¿Estás seguro de que quieres eliminar esta categoría?")) {
            document.getElementById('form-eliminar-' + categoriaId).submit();
        }
    }
    </script>
    

<script>
    $(document).ready(function () {
    $('#categorias').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('categorias.lista') }}",
        lengthMenu: [[25, 50, 100, -1], ['25', '50', '100', 'Todos']],
        columns: [
            {data: 'id'},
            {data: 'nombre', defaultContent: ''},
            {data: 'acciones', orderable: false, searchable: false}
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
@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Registro de Marcas</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">
    <a href="marcas/create" class="btn btn-primary">CREAR</a>
    <p></p>
    <table id="marcas" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-prymary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Marca</th>
                <th>Acciones</th>
                
            </tr>
        </thead>
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
    function confirmDelete(marcaId) {
        if (confirm("¿Estás seguro de que quieres eliminar esta marca?")) {
            document.getElementById('form-eliminar-' + marcaId).submit();
        }
    }
    </script>
    

<script>
    $(document).ready(function () {
    $('#marcas').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('marcas.lista') }}",
        columns: [
            {data: 'id'},
            {data: 'marca', defaultContent: ''},
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
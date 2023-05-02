@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Memorandos Bodega</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">
    @can('crear-memorando')
    <a href="memorandos/create" class="btn btn-primary">CREAR</a>
    @endcan
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editEncargadoModal">
        Editar Nombre Encargado
    </button>
    <p></p>
    <table id="memorandos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-prymary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Empleado</th>
                <th scope="col">Direccion</th>
                <th scope="col">N° Contacto</th>
                <th scope="col">Correo Encargado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
</div>
<div class="modal fade" id="editEncargadoModal" tabindex="-1" role="dialog" aria-labelledby="editEncargadoModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editEncargadoModalLabel">Editar nombre encargado de bodega</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <form id="editEncargadoForm" action="{{ route('encargado.update', $encargado->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="form-group">
                        <label for="destinatario">Nombre Encargado</label>
                        <input type="text" class="form-control" id="encargado" name="encargado" value="{{ $encargado->encargado_bodega }}">
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <a href="/memorandos" class="btn btn-secondary" >Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>

        </div>
    </div>
</div>
@stop
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
<script>
    function confirmDelete(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este dato de software?')) {
            $('#form-eliminar-' + id).submit();
        }
    }
</script>
<script>
    $(document).ready(function () {
    $('#memorandos').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('memorandos.lista') }}",
        lengthMenu: [[25, 50, 100, -1], ['25', '50', '100', 'Todos']],
        columns: [
            {data: 'id'},
            {data: 'empleado.nombre', name:'empleado.nombre', defaultContent: ''},
            {data: 'direccion', defaultContent: ''},
            {data: 'n_contacto', defaultContent: ''},
            {data: 'correo_encargado', defaultContent: ''},
            { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
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
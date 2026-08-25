@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('title', 'Mantenimientos')

@section('content_header')
    <h1>Mantenimientos</h1>
@stop

@section('content')
<div class="card">
<div class="card-body">

    {{-- Filtros externos --}}
    <div class="row align-items-end mb-3">
        <div class="col-md-2">
            <label for="fTipo">Tipo de equipo</label>
            <select id="fTipo" class="form-control form-control-sm">
                <option value="">Todos</option>
                <option value="cpu">CPU / Portátil</option>
                <option value="telefono">Celular</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="fEstado">Estado</label>
            <select id="fEstado" class="form-control form-control-sm">
                <option value="">Todos</option>
                <option value="pendiente">Pendiente</option>
                <option value="en_progreso">En progreso</option>
                <option value="completado">Completado</option>
                <option value="cancelado">Cancelado</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="fDesde">Desde</label>
            <input type="date" id="fDesde" class="form-control form-control-sm">
        </div>
        <div class="col-md-2">
            <label for="fHasta">Hasta</label>
            <input type="date" id="fHasta" class="form-control form-control-sm">
        </div>
        <div class="col-md-4 text-left">
            <button id="btnFiltrar" class="btn btn-primary btn-sm">Aplicar filtros</button>
            <button id="btnLimpiar" class="btn btn-secondary btn-sm">Limpiar</button>
        </div>
    </div>

    <table id="mantenimientos" class="table table-striped table-bordered shadow-lg mt-2" style="width:100%">
        <thead class="">
            <tr>
                <th>ID</th>
                <th>Equipo</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Técnico</th>
                <th>Descripción</th>
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
$(document).ready(function () {
    var tabla = $('#mantenimientos').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('mantenimientos.lista') }}",
            data: function (d) {
                d.tipo = $('#fTipo').val();
                d.estado = $('#fEstado').val();
                d.fecha_desde = $('#fDesde').val();
                d.fecha_hasta = $('#fHasta').val();
            }
        },
        lengthMenu: [[25, 50, 100, -1], ['25', '50', '100', 'Todos']],
        order: [[0, 'desc']],
        columns: [
            {data: 'id'},
            {data: 'equipo'},
            {data: 'tipo'},
            {data: 'estado_badge'},
            {data: 'created_at'},
            {data: 'usuario_nombre'},
            {data: 'descripcion', defaultContent: ''},
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

    $('#btnFiltrar').on('click', function () {
        tabla.draw();
    });

    $('#btnLimpiar').on('click', function () {
        $('#fTipo').val('');
        $('#fEstado').val('');
        $('#fDesde').val('');
        $('#fHasta').val('');
        tabla.draw();
    });
});
</script>
@stop

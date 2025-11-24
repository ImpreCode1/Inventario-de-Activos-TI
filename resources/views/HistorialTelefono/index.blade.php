@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="/vendor/select2/css/select2.min.css">

    <style>
        .filtros-container {
            margin-bottom: 20px;
        }

        .filtros-container label {
            font-weight: normal;
        }
    </style>
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Historial Telefonos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="row mb-4">
                {{-- Filtro Trazabilidad Equipo --}}
                <div class="col-md-4">
                    <label for="filtro_serial" class="form-label">Trazabilidad por Equipo (Serial)</label>
                    <select id="filtro_serial" class="form-control">
                        <option value="">-- Seleccione un serial --</option>
                        @foreach ($telefonos as $telefono)
                            <option value="{{ $telefono->serial }}">
                                {{ $telefono->serial }}{{ !empty($telefono->modelo) ? ' - ' . $telefono->modelo : '' }}
                            </option>
                        @endforeach
                    </select>

                </div>

                {{-- Filtro Historial Empleado --}}
                <div class="col-md-4">
                    <label for="filtro_empleado" class="form-label">Historial por Empleado</label>
                    <select id="filtro_empleado" class="form-control">
                        <option value="">-- Seleccione un empleado --</option>
                        @foreach ($empleados as $empleado)
                            {{-- Usamos el nombre para buscar --}}
                            <option value="{{ $empleado->nombre }}">{{ $empleado->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Botones --}}
                <div class="col-md-4 d-flex align-items-end">
                    <button id="btn-filtrar" class="btn btn-primary mr-2">Filtrar</button>
                    <button id="btn-reset" class="btn btn-secondary">Limpiar</button>
                </div>
            </div>

            <p></p>
            <table id="historialTelefonos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                <thead class="bg-prymary">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Empleado</th>
                        <th scope="col">Serial</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Fecha Asignacion</th>
                        <th scope="col">Fecha Devolucion</th>
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
    <script src="/vendor/select2/js/select2.min.js"></script>
    <script>
        function confirmDelete(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este historial?')) {
                $('#form-eliminar-' + id).submit();
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#filtro_serial').select2({
                placeholder: "-- Seleccione un serial --",
                allowClear: true,
                width: "100%"
            });

            // Fix de foco para Equipos
            $('#filtro_serial').on('select2:open', function(e) {
                document.querySelector('.select2-search__field').focus();
            });

            // Configuración para Filtro de Empleados
            $('#filtro_empleado').select2({
                placeholder: "-- Seleccione un empleado --",
                allowClear: true,
                width: "100%"
            });

            // Fix de foco para Empleados
            $('#filtro_empleado').on('select2:open', function(e) {
                document.querySelector('.select2-search__field').focus();
            });

            var table = $('#historialTelefonos').DataTable({
                processing: true,
                serverSide: true,
                order: [
                    [0, 'desc']
                ],
                searching: false,
                ajax: {
                    url: "{{ route('historialtelefonos.lista') }}",
                    data: function(d) {
                        d.serial = $('#filtro_serial').val();
                        d.empleado = $('#filtro_empleado').val();
                    }
                },
                dom: '<"dt-buttons d-flex justify-content-between"B<"ml-3"l>>frtip',
                lengthChange: true,
                lengthMenu: [
                    [25, 50, 100, -1],
                    ['25', '50', '100', 'Todos']
                ],
                buttons: [{
                    extend: 'excelHtml5',
                    title: 'Reporte de Historial de Telefonos',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                }],
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'empleado.nombre',
                        name: 'empleado.nombre',
                        defaultContent: ''
                    },
                    {
                        data: 'telefono.serial',
                        name: 'telefono.serial',
                        defaultContent: ''
                    },
                    {
                        data: 'telefono.modelo',
                        name: 'telefono.modelo',
                        defaultContent: ''
                    },
                    {
                        data: 'fecha_asignacion',
                        defaultContent: ''
                    },
                    {
                        data: 'fecha_devolucion',
                        defaultContent: ''
                    },
                    {
                        data: 'action',
                        name: 'acciones',
                        orderable: false,
                        searchable: false
                    },
                ],
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por pagina",
                    "zeroRecords": "Nada encontrado - disculpa",
                    "info": "Mostrar la pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(Filtrado de  _MAX_ Registros totales)",
                    "search": "Buscar",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });

            $('#btn-filtrar').click(function() {
                table.draw(); // Recarga la tabla enviando los datos de los inputs
            });

            $('#btn-reset').click(function() {
                $('#filtro_serial').val(''); // Limpia input
                $('#filtro_empleado').val(''); // Limpia input
                table.draw(); // Recarga la tabla limpia
            });
        });
    </script>
@stop

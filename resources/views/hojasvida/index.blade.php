@extends('adminlte::page')

@section('title', 'Hojas de Vida')

@section('css')
    <link rel="stylesheet" href="/vendor/select2/css/select2.min.css">
@stop

@section('content_header')
    <h1>Hojas de Vida de Equipos</h1>
@stop

@section('content')

    {{-- Buscador --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Buscar Equipo
        </div>

        <div class="card-body">
            <form action="{{ route('hojasvida.index') }}" method="GET">

                <div class="row">

                    {{-- Buscar por activo/serial/imei --}}
                    {{-- SELECT2 para activo/serial/imei --}}
                    <div class="col-md-4">
                        <label for="filtro_equipo">Activo / Serial </label>
                        <select id="filtro_equipo" name="q" class="form-control select2">
                            <option value="">-- Buscar equipo --</option>
                            @foreach ($equipos as $e)
                                <option value="{{ $e->codigo_busqueda }}">
                                    {{ $e->codigo_busqueda }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- SELECT2 para usuario --}}
                    <div class="col-md-4">
                        <label for="filtro_usuario">Asignado a</label>
                        <select id="filtro_usuario" name="usuario" class="form-control select2">
                            <option value="">-- Buscar usuario --</option>
                            @foreach ($empleados as $u)
                                <option value="{{ $u->nombre }}">{{ $u->nombre }}</option>
                            @endforeach
                        </select>
                    </div>



                    {{-- Botón --}}
                    <div class="col-md-4 d-flex align-items-end">
                        <button class="btn btn-primary btn-block">Buscar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    {{-- Resultados --}}
    <div class="card">
        <div class="card-header bg-secondary text-white">
            Resultados de la búsqueda
        </div>

        <div class="card-body p-0">

            <table class="table table-striped m-0">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Activo / Serial </th>
                        <th>Usuario</th>
                        <th style="width: 130px">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($resultados as $r)
                        <tr>
                            <td>{{ strtoupper($r->tipo) }}</td>

                            <td>
                                @if ($r->tipo === 'cpu')
                                    {{ $r->n_activo }} — {{ $r->n_serial }}
                                @elseif ($r->tipo === 'telefono')
                                    {{ $r->serial }} — {{ $r->imei }}
                                @endif
                            </td>

                            <td>{{ $r->empleado->nombre ?? 'No asignado' }}</td>

                            <td>
                                <a href="{{ route('hojasvida.show', [$r->tipo, $r->id]) }}" class="btn btn-sm btn-primary">
                                    Ver Hoja
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-3">No se encontraron resultados</td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="/vendor/select2/js/select2.min.js"></script>

<script>
    $(document).ready(function() {

        // EQUIPOS - Activo / Serial / IMEI
        $('#filtro_equipo').select2({
            placeholder: "-- Buscar equipo --",
            allowClear: true,
            width: "100%"
        });

        $('#filtro_equipo').on('select2:open', function(e) {
            document.querySelector('.select2-search__field').focus();
        });

        // USUARIOS
        $('#filtro_usuario').select2({
            placeholder: "-- Buscar usuario --",
            allowClear: true,
            width: "100%"
        });

        $('#filtro_usuario').on('select2:open', function(e) {
            document.querySelector('.select2-search__field').focus();
        });

    });
</script>
@stop

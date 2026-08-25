@extends('adminlte::page')

@section('title', 'Hoja de Vida del Equipo')

@section('content_header')
    <h1>Hoja de Vida del Equipo ({{ strtoupper($tipo) }})</h1>
@stop

@section('content')

    {{-- Mensaje de confirmación --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Información del equipo --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Información del Equipo
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $equipo->id }}</p>

            @if ($tipo === 'cpu')
                <p><strong>Activo:</strong> {{ $equipo->n_activo }}</p>
                <p><strong>Serial:</strong> {{ $equipo->n_serial }}</p>
                <p><strong>Referencia:</strong> {{ $equipo->serie ?? 'Sin marca' }}</p>
            @elseif ($tipo === 'telefono')
                <p><strong>Serial:</strong> {{ $equipo->serial }}</p>
                <p><strong>IMEI:</strong> {{ $equipo->email_1 }}</p>
                <p><strong>Modelo:</strong> {{ $equipo->modelo ?? 'Sin marca' }}</p>
            @endif

            <a href="#" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modalRegistrarEvento">
                Registrar Evento
            </a>
        </div>
    </div>

    {{-- Tabla de historial --}}
    <div class="card">
        <div class="card-header bg-secondary text-white">
            Historial Técnico
        </div>

        <div class="card-body p-0">
            <table class="table custom-table m-0" id="tablaHistorial">
                <thead class="custom-table-header">
                    <tr>
                        <th style="width: 150px">Fecha</th>
                        <th>Evento</th>
                        <th style="width: 130px">Estado</th>
                        <th style="width: 180px">Adjuntos</th>
                        <th>Descripción</th>
                        <th style="width: 150px">Usuario</th>
                    </tr>
                    <tr>
                        <th>
                            <input type="text" class="form-control form-control-sm filtro" placeholder="Filtrar fecha">
                        </th>
                        <th>
                            <input type="text" class="form-control form-control-sm filtro" placeholder="Filtrar evento">
                        </th>
                        <th>
                            <input type="text" class="form-control form-control-sm filtro" placeholder="Filtrar estado">
                        </th>
                        <th>
                            <input type="text" class="form-control form-control-sm filtro" placeholder="Filtrar adjunto">
                        </th>
                        <th>
                            <input type="text" class="form-control form-control-sm filtro"
                                placeholder="Filtrar descripción">
                        </th>
                        <th>
                            <input type="text" class="form-control form-control-sm filtro" placeholder="Filtrar usuario">
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($historial as $item)
                        {{-- Colores de badges --}}
                        @php
                            $colores = [
                                // --- Asignaciones ---
                                'ASIGNACIÓN' => 'badge-dark',

                                // --- Técnicos ---
                                'INCIDENTE' => 'badge-danger',
                                'MANTENIMIENTO' => 'badge-primary',
                                'CAMBIO_PIEZA' => 'badge-danger',
                                'AUMENTO_RAM' => 'badge-success',
                                'INSTALACION_SOFTWARE' => 'badge-info',
                                'BACKUP' => 'badge-warning',
                                'FORMATEO' => 'badge-warning',
                                'DIAGNOSTICO' => 'badge-secondary',
                                'CAMBIO_SIM' => 'badge-info',
                                'DAÑO_FISICO' => 'badge-danger',
                                'ROBO_PERDIDA' => 'badge-danger',
                                'OTRO' => 'badge-light',
                            ];

                            $estadosColores = [
                                'pendiente' => 'badge-warning',
                                'en_progreso' => 'badge-info',
                                'completado' => 'badge-success',
                                'cancelado' => 'badge-secondary',
                            ];

                            $eventoClave = strtoupper($item->evento);
                            $color = $colores[$eventoClave] ?? 'badge-primary';
                            $estadoColor = $estadosColores[$item->estado] ?? 'badge-secondary';
                        @endphp

                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->fecha)->format('Y-m-d H:i') }}</td>
                            <td><span class="badge {{ $color }}">{{ $item->evento }}</span></td>
                            <td>
                                @if ($item->tipo === 'tecnico')
                                    <span class="badge {{ $estadoColor }}">
                                        {{ ucfirst(str_replace('_', ' ', $item->estado)) }}
                                    </span>
                                @else
                                    ---
                                @endif
                            </td>
                            <td>
                                @forelse(($item->adjuntos ?? collect()) as $adjunto)
                                    <a href="{{ $adjunto->url() }}" target="_blank" class="d-block text-truncate"
                                        title="{{ $adjunto->nombre_archivo }}">
                                        <i class="fas fa-paperclip"></i>
                                        {{ \Illuminate\Support\Str::limit($adjunto->nombre_archivo, 20) }}
                                    </a>
                                @empty
                                    ---
                                @endforelse
                            </td>
                            <td>{{ $item->descripcion }}</td>
                            <td>{{ $item->usuario }}</td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-3">Sin registros todavía</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal para registrar evento --}}
    <div class="modal fade" id="modalRegistrarEvento" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('hojasvida.store', [$tipo, $equipo->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Registrar Evento Técnico</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="evento">Tipo de evento</label>
                            <select name="evento" id="evento" class="form-control" required>
                                <option value="">Seleccione...</option>
                                <option value="incidente">Incidente</option>
                                <option value="mantenimiento">Mantenimiento</option>
                                <option value="cambio_pieza">Cambio de pieza</option>
                                <option value="aumento_ram">Aumento de RAM</option>
                                <option value="instalacion_software">Instalación de software</option>
                                <option value="backup">Backup</option>
                                <option value="formateo">Formateo</option>
                                <option value="diagnostico">Diagnóstico</option>
                                <option value="cambio_sim">Cambio de SIM o Línea</option>
                                <option value="daño_fisico">Reporte de Daño Físico</option>
                                <option value="robo_perdida">Pérdida o Robo del Equipo</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="estado">Estado del evento</label>
                            <select name="estado" id="estado" class="form-control" required>
                                <option value="pendiente">Pendiente</option>
                                <option value="en_progreso">En progreso</option>
                                <option value="completado" selected>Completado</option>
                                <option value="cancelado">Cancelado</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción detallada</label>
                            <textarea name="descripcion" id="descripcion" rows="4" class="form-control"
                                placeholder="Describe lo que se le hizo al equipo... (opcional)"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="adjuntos">Evidencias (máx. 5 archivos, 10 MB c/u)</label>
                            <input type="file" name="adjuntos[]" id="adjuntos" class="form-control-file"
                                multiple accept=".pdf,.jpg,.jpeg,.png,.webp,.doc,.docx,.xls,.xlsx">
                            <small class="form-text text-muted">PDF, imágenes o documentos de Office.</small>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Evento</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filtros = document.querySelectorAll('.filtro');
            const filas = document.querySelectorAll('#tablaHistorial tbody tr');

            filtros.forEach((input, index) => {
                input.addEventListener('keyup', () => {
                    const valor = input.value.toLowerCase();

                    filas.forEach(fila => {
                        const celda = fila.cells[index];
                        if (!celda) return;

                        const texto = celda.textContent.toLowerCase();
                        fila.style.display = texto.includes(valor) ? '' : 'none';
                    });
                });
            });
        });
    </script>
@stop

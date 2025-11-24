<?php

namespace App\Http\Controllers;

use App\Models\CpuEquipo;
use App\Models\Empleado;
use App\Models\HistorialEquipo;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate; // Asegúrate de tener esto o usar el helper datatables()

class HistorialEquipoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-HistorialEquipo|borrar-HistorialEquipo')->only('index');
        $this->middleware('permission:borrar-HistorialEquipo', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // <--- Asegúrate de importar tus modelos

    public function index()
    {
        // Obtenemos listas simples para llenar los selects
        // Pluck crea un array asociativo [valor => texto] o simplemente una lista

        // Lista de Empleados (Ordenados por nombre)
        $empleados = Empleado::orderBy('nombre', 'asc')->get();

        // Lista de Equipos (Ordenados por N° activo)
        // Asumo que quieres mostrar el N° activo y quizás el modelo o nombre para guiar al usuario
        $equipos = CpuEquipo::orderBy('n_activo', 'asc')->get();

        return view('HistorialEquipo.index', compact('empleados', 'equipos'));
    }

    // AQUI ESTA LA MODIFICACION PRINCIPAL
    public function historialEquipos(Request $request)
    {
        if (Gate::denies('ver-HistorialEquipo')) {
            abort(403); // Acceso no autorizado
        }

        $query = HistorialEquipo::with(['empleado', 'cpuequipo.categoria'])
                ->select('historial_equipos.*');

        return datatables()->of($query)
            // 2. Agregamos la lógica de filtrado personalizado
            ->filter(function ($instance) use ($request) {
                // A. Filtro por N° de Activo (Trazabilidad del equipo)
                if ($request->has('n_activo') && !empty($request->get('n_activo'))) {
                    $instance->whereHas('cpuequipo', function ($w) use ($request) {
                        $w->where('n_activo', 'like', "%{$request->get('n_activo')}%");
                    });
                }

                // B. Filtro por Empleado (Historial del usuario)
                if ($request->has('empleado') && !empty($request->get('empleado'))) {
                    $instance->whereHas('empleado', function ($w) use ($request) {
                        $w->where('nombre', 'like', "%{$request->get('empleado')}%");
                    });
                }

                // C. Mantenemos la búsqueda global estándar de DataTables (la cajita "Buscar")
                if (!empty($request->get('search')['value'])) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->get('search')['value'];
                        $w->orWhereHas('empleado', function ($q) use ($search) {
                            $q->where('nombre', 'like', "%$search%");
                        })
                        ->orWhereHas('cpuequipo', function ($q) use ($search) {
                            $q->where('n_activo', 'like', "%$search%");
                        });
                    });
                }
            })
            // 3. Renderizado de columnas (Tu código original de botones)
            ->addColumn('action', function ($equipo) {
                $html = '<div class="d-flex justify-content-center align-items-center flex-wrap action-buttons">';

                if (Gate::allows('borrar-HistorialEquipo', $equipo)) {
                    $html .= '
                    <form id="form-eliminar-'.$equipo->id.'"
                        action="'.route('equiposHistorial.destroy', $equipo->id).'"
                        method="POST" style="display:inline;">
                        '.csrf_field().method_field('DELETE').'
                        <button type="button"
                                class="btn-icon btn-outline-danger"
                                title="Eliminar"
                                onclick="confirmDelete('.$equipo->id.')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>';
                }

                $html .= '</div>';

                return $html;
            })
            ->rawColumns(['action'])
            ->make(true); // Usamos make(true) en lugar de toJson() es más estándar, pero ambos funcionan
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipo = HistorialEquipo::find($id);
        // Es buena práctica verificar si existe antes de borrar
        if ($equipo) {
            $equipo->delete();
        }

        return redirect('/equiposHistorial');
    }
}

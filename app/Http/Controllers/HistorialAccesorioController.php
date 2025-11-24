<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\HistorialAccesorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HistorialAccesorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-HistorialAccesesorio|borrar-HistorialAccesesorio')->only('index');
        $this->middleware('permission:borrar-HistorialAccesesorio', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::orderBy('nombre', 'asc')->get();

        return view('HistorialAccesesorio.index', compact('empleados'));
    }

    public function historialaccesesorio(Request $request)
    {
        if (Gate::denies('ver-HistorialAccesesorio')) {
            abort(403); // Acceso no autorizado
        }

        $query = HistorialAccesorio::with(['empleado', 'accesesorio', 'accesesorio.categoria'])
                ->select('historial_accesorios.*');

        return datatables()->of($query)
            ->filter(function ($instance) use ($request) {
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
                        });
                    });
                }
            })

            ->addColumn('action', function ($historial) {
                $html = '<div class="d-flex justify-content-center align-items-center flex-wrap action-buttons">';

                if (Gate::allows('borrar-HistorialAccesesorio', $historial)) {
                    $html .= '
            <form id="form-eliminar-'.$historial->id.'"
                action="'.route('accesesoriosHistorial.destroy', $historial->id).'"
                method="POST" style="display:inline;">
                '.csrf_field().method_field('DELETE').'
                <button type="button"
                        class="btn-icon btn-outline-danger"
                        title="Eliminar"
                        onclick="confirmDelete('.$historial->id.')">
                    <i class="fas fa-trash"></i>
                </button>
            </form>';
                }

                $html .= '</div>';

                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
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
        $accesorio = HistorialAccesorio::find($id);
        if ($accesorio) {
            $accesorio->delete();
        }

        return redirect('/accesesoriosHistorial');
    }
}

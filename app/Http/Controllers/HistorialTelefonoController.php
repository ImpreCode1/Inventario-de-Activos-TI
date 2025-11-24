<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\HistorialTelefono;
use App\Models\Telefono;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HistorialTelefonoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-HistorialTelefono|borrar-HistorialTelefono')->only('index');
        $this->middleware('permission:borrar-HistorialTelefono', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::orderBy('nombre', 'asc')->get();
        $telefonos = Telefono::orderBy('serial', 'asc')->get();

        return view('HistorialTelefono.index', compact('empleados', 'telefonos'));
    }

    public function historialTelefonos(Request $request)
    {
        if (Gate::denies('ver-HistorialTelefono')) {
            abort(403);
        }

        $query = HistorialTelefono::with(['empleado', 'telefono'])
                ->select('historial_telefonos.*');

        return datatables()->of($query)

        ->filter(function ($instance) use ($request) {
            // FILTRO SERIAL
            if ($request->serial) {
                $instance->whereHas('telefono', function ($q) use ($request) {
                    $q->where('serial', 'like', "%{$request->serial}%");
                });
            }

            // FILTRO EMPLEADO
            if ($request->empleado) {
                $instance->whereHas('empleado', function ($q) use ($request) {
                    $q->where('nombre', 'like', "%{$request->empleado}%");
                });
            }
        })

            ->addColumn('action', function ($telefono) {
                $html = '<div class="d-flex justify-content-center align-items-center flex-wrap action-buttons">';

                if (Gate::allows('borrar-HistorialTelefono', $telefono)) {
                    $html .= '
            <form id="form-eliminar-'.$telefono->id.'"
                action="'.route('telefonosHistorial.destroy', $telefono->id).'"
                method="POST" style="display:inline;">
                '.csrf_field().method_field('DELETE').'
                <button type="button"
                        class="btn-icon btn-outline-danger"
                        title="Eliminar"
                        onclick="confirmDelete('.$telefono->id.')">
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
        $telefono = HistorialTelefono::find($id);
        if ($telefono) {
            $telefono->delete();
        }

        return redirect('/telefonosHistorial');
    }
}

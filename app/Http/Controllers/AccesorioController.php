<?php

namespace App\Http\Controllers;

use App\Models\Accesorio;
use App\Models\Categoria;
use App\Models\Marca;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AccesorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-accesesorio|crear-accesesorio|editar-accesesorio|borrar-accesesorio|pdf-accesesorio')->only('index');
        $this->middleware('permission:crear-accesesorio', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-accesesorio', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-accesesorio', ['only' => ['destroy']]);
        $this->middleware('permission:pdf-accesesorio', ['only' => ['pdf']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accesorio.index');
    }

    public function accesesorios()
    {
        if (Gate::denies('ver-accesesorio')) {
            abort(403); // Acceso no autorizado
        }
        $query = Accesorio::with(['categoria', 'marca', 'empleado'])
                ->select('accesorios.*');

        return datatables()->of($query)
        ->addColumn('action', function ($accesorio) {
            $html = '<div class="d-flex justify-content-center align-items-center flex-wrap action-buttons">';

            if (Gate::allows('editar-accesesorio', $accesorio)) {
                $html .= '
                <a href="/accesorios/'.$accesorio->id.'/edit" 
                class="btn-icon btn-outline-primary" 
                title="Editar">
                <i class="fas fa-pen"></i>
                </a>';
            }

            if (Gate::allows('pdf-accesesorio', $accesorio)) {
                $html .= '
                <a href="/accesorios/'.$accesorio->id.'/pdf" target="_blank" 
                class="btn-icon btn-outline-success" 
                title="R.D.U">
                <i class="fas fa-file-pdf"></i>
                </a>';
            }

            if (Gate::allows('borrar-accesesorio', $accesorio)) {
                $html .= '
                <form id="form-eliminar-'.$accesorio->id.'" 
                    action="'.route('accesorios.destroy', $accesorio->id).'" 
                    method="POST" style="display:inline;">
                    '.csrf_field().method_field('DELETE').'
                    <button type="button" 
                            class="btn-icon btn-outline-danger" 
                            title="Eliminar"
                            onclick="confirmDelete('.$accesorio->id.')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>';
            }

            $html .= '</div>';

            return $html;
        })

        ->rawColumns(['action'])->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = DB::table('categorias')->whereNotIn('nombre', ['CELULAR', 'PORTATIL'])->orderBy('nombre', 'asc')->get();
        $marcas = DB::table('marcas')->orderBy('marca', 'asc')->get();
        $marcas_ordenadas = [];
        foreach ($marcas as $marca) {
            $marcas_ordenadas[$marca->id] = $marca->marca;
        }
        $empleados = DB::table('empleados')->orderByRaw('CASE WHEN id=0 THEN 0 ELSE 1 END, nombre ASC')->get();
        $empleados_ordenados = [];
        foreach ($empleados as $empleado) {
            $empleados_ordenados[$empleado->id] = $empleado->nombre;
        }

        return view('accesorio.create', compact('categorias', 'marcas_ordenadas', 'empleados_ordenados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accesorio = new Accesorio();
        $accesorio->id_categoria = $request->get('id_categoria');
        $accesorio->id_marca = $request->get('id_marca');
        $accesorio->serie = $request->get('serie');
        $accesorio->n_serial = $request->get('n_serial');
        $accesorio->n_parte = $request->get('n_parte');
        $accesorio->observaciones = $request->get('observaciones');
        $accesorio->id_empleado = $request->get('id_empleado');

        $accesorio->save();

        return redirect('/accesorios');
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
        $accesorio = Accesorio::find($id);
        $categoria = Categoria::whereIn('nombre', ['DIADEMA', 'MOUSE', 'MONITOR', 'TECLADO', 'TERMINAL', 'IMPRESORA', 'VIDEOPROYECTOR', 'SWITCH', 'TABLET', 'BASE REFRIGERANTE'])->get();
        $marca = Marca::orderBy('marca', 'asc')->get();
        $empleado = DB::table('empleados')->orderByRaw('CASE WHEN id=0 THEN 0 ELSE 1 END, nombre ASC')->get();

        return view('accesorio.edit', compact('accesorio', 'categoria', 'marca', 'empleado'));
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
        $accesorio = Accesorio::find($id);
        $accesorio->id_categoria = $request->get('id_categoria');
        $accesorio->id_marca = $request->get('id_marca');
        $accesorio->serie = $request->get('serie');
        $accesorio->n_serial = $request->get('n_serial');
        $accesorio->n_parte = $request->get('n_parte');
        $accesorio->observaciones = $request->get('observaciones');
        $accesorio->id_empleado = $request->get('id_empleado');

        $accesorio->save();
        if ($request->input('id_empleado') == 0) {
            $accesorio->setEstadoDisponible();
        } else {
            Accesorio::actualizarAccesesorio($id, $request->get('id_empleado'));
        }

        return redirect('/accesorios');
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
        $accesorio = Accesorio::find($id);
        $accesorio->delete();

        return redirect('/accesorios');
    }

    public function pdf($id)
    {
        $fechaActual = Carbon::now()->format('d/m/Y');
        $accesorios = Accesorio::where('id', $id)->get();

        $pdf = Pdf::loadView('accesorio.pdf', compact('accesorios', 'fechaActual'));

        return $pdf->stream('Responsabilidad_accesorio.pdf');
    }
}

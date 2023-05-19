<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accesorio;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Empleado;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class AccesorioController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-accesesorio|crear-accesesorio|editar-accesesorio|borrar-accesesorio|pdf-accesesorio')->only('index');
        $this->middleware('permission:crear-accesesorio', ['only'=>['create', 'store']]);
        $this->middleware('permission:editar-accesesorio', ['only'=>['edit', 'update']]);
        $this->middleware('permission:borrar-accesesorio', ['only'=>['destroy']]);
        $this->middleware('permission:pdf-accesesorio', ['only'=>['pdf']]);
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
        public function accesesorios(){

                    
        if (Gate::denies('ver-accesesorio')) {
            abort(403); // Acceso no autorizado
        }

            $accesorios = Accesorio::with(['categoria', 'marca', 'empleado'])->select('id', 'id_empleado', 'id_categoria', 'id_marca', 'n_serial', 'n_parte', 'observaciones', 'serie')->get();
            return datatables()->of($accesorios)
            ->addColumn('action', function ($accesorio) {
                $html = '';
                if (Gate::allows('editar-accesesorio', $accesorio)) {
                    $html .= '<a href="/accesorios/'.$accesorio->id.'/edit" class="btn btn-info btn-sm">Editar</a>';
                }
                if (Gate::allows('pdf-accesesorio', $accesorio)) {
                    $html .= '<a href="/accesorios/' . $accesorio->id . '/pdf" target="_blank" class="btn btn-success btn-sm">Responsabilidad Usu</a>';
                }
                if (Gate::allows('borrar-accesesorio', $accesorio)) {
                    $html .= '<form id="form-eliminar-' . $accesorio->id . '" action="'. route('accesorios.destroy', $accesorio->id) .'" method="POST" style="display: inline-block;">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $accesorio->id . ')">Eliminar</button>
                    </form>';
                }
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
        $categorias = Categoria::whereIn('nombre', ['DIADEMA', 'MOUSE', 'MONITOR', 'TECLADO', 'TERMINAL', 'IMPRESORA', 'VIDEOPROYECTOR','SWITCH', 'TABLET', 'BASE REFRIGERANTE'])->get();
        $marcas =  DB::table('marcas')->orderBy('marca', 'asc')->get();
        $marcas_ordenadas = array();
        foreach ($marcas as $marca) {
            $marcas_ordenadas[$marca->id] = $marca->marca;
        };
        $empleados =  DB::table('empleados')->orderByRaw("CASE WHEN id=0 THEN 0 ELSE 1 END, nombre ASC")->get();
        $empleados_ordenados = array();
        foreach ($empleados as $empleado) {
            $empleados_ordenados[$empleado->id] = $empleado->nombre;
        };
        return view('accesorio.create', compact('categorias', 'marcas_ordenadas', 'empleados_ordenados')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accesorio = new Accesorio();
        $accesorio-> id_categoria = $request->get('id_categoria');
        $accesorio-> id_marca = $request->get('id_marca');
        $accesorio-> serie = $request->get('serie');
        $accesorio-> n_serial = $request->get('n_serial');
        $accesorio-> n_parte = $request->get('n_parte');
        $accesorio-> observaciones = $request->get('observaciones');
        $accesorio-> id_empleado = $request->get('id_empleado');

        $accesorio->save();

        return redirect('/accesorios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accesorio = Accesorio::find($id);
        $categoria = Categoria::whereIn('nombre', ['DIADEMA', 'MOUSE', 'MONITOR', 'TECLADO', 'TERMINAL', 'IMPRESORA', 'VIDEOPROYECTOR','SWITCH', 'TABLET', 'BASE REFRIGERANTE'])->get();
        $marca = Marca::orderBy('marca', 'asc')->get();
        $empleado =  DB::table('empleados')->orderByRaw("CASE WHEN id=0 THEN 0 ELSE 1 END, nombre ASC")->get();
        return view('accesorio.edit', compact( 'accesorio', 'categoria', 'marca', 'empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $accesorio = Accesorio::find($id);
        $accesorio-> id_categoria = $request->get('id_categoria');
        $accesorio-> id_marca = $request->get('id_marca');
        $accesorio-> serie = $request->get('serie');
        $accesorio-> n_serial = $request->get('n_serial');
        $accesorio-> n_parte = $request->get('n_parte');
        $accesorio-> observaciones = $request->get('observaciones');
        $accesorio-> id_empleado = $request->get('id_empleado');

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
     * @param  int  $id
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

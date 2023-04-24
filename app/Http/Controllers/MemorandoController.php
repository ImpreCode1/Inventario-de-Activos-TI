<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memorando;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Empleado;
use Illuminate\Support\Carbon;
use App\Models\Encargado;

class MemorandoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $encargado = Encargado::findOrFail(1);
        return view('Memorando.index')->with('encargado', $encargado);;
    }

    public function memorandos(){
        $memorandos = Memorando::with(['empleado'])->select('id', 'id_empleado', 'ciudad', 'direccion', 'n_contacto', 'correo_encargado')->get();
        return datatables()->of($memorandos)->addColumn('acciones', function ($memorando) {
            $id_memorando = $memorando->id;
            $id_empleado = $memorando->id_empleado;
            $url_pdf = route('memorandos.pdf', [$id_memorando, $id_empleado]);
            return '
            <a href="' . $url_pdf . '" target="_blank" class="btn btn-success btn-sm">Memorando</a>
            <form id="form-eliminar-' . $memorando->id . '" action="' . route('memorandos.destroy', $memorando->id) . '" method="POST">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $memorando->id . ')">Eliminar</button>
            </form>';
        })
        ->rawColumns(['acciones'])->toJson();
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
{
    $empleados =  DB::table('empleados')
        ->where('id', '<>', 0)
        ->orderBy('nombre', 'asc')
        ->get();
    $empleados_ordenados = [];
    foreach ($empleados as $empleado) {
        $empleados_ordenados[$empleado->id] = $empleado->nombre;
    }

    // Obtener los datos del empleado y sus asignaciones
    $empleado = Empleado::with(['equipos', 'accesorios', 'telefonos'])->find($request->input('id_empleado'));

    return view('memorando.create', compact('empleados_ordenados', 'empleado'));
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $memorando = new Memorando();
        $memorando->id_empleado = $request->input('id_empleado');
        $memorando->ciudad = $request->input('ciudad');
        $memorando->direccion = $request->input('direccion');
        $memorando->n_contacto = $request->input('n_contacto');
        $memorando->correo_encargado = $request->input('correo_encargado');
        $memorando->save();
        return redirect('/memorandos');
    
     
    }
    public function updateEncargado(Request $request, $id)
    {
        $encargado = Encargado::find($id);
        $encargado->encargado_bodega = $request->input('encargado');
        $encargado->save();
    
        return redirect('/memorandos')->with('success', 'Encargado actualizado exitosamente.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('memorando.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $memorando = Memorando::find($id);
        $memorando->delete();
        return redirect('/memorandos');
    }

    public function pdf($id_memorando, $id_empleado)
    {
        $fechaActual = Carbon::now()->format('d/m/Y');

        $resultados = DB::table('empleados')
        ->leftJoin('cpu_equipos', 'cpu_equipos.id_empleado', '=', 'empleados.id')
        ->leftJoin('accesorios', 'accesorios.id_empleado', '=', 'empleados.id')
        ->leftJoin('telefonos', 'telefonos.id_empleado', '=', 'empleados.id')
        ->leftJoin('categorias', 'categorias.id', '=', 'cpu_equipos.id_categoria')
        ->leftJoin('categorias as cat2', 'cat2.id', '=', 'accesorios.id_categoria')
        ->leftJoin('categorias as cat3', 'cat3.id', '=', 'telefonos.id_categoria')
        ->leftJoin('marcas', 'marcas.id', '=', 'cpu_equipos.id_marca')
        ->leftJoin('marcas as mar2', 'mar2.id', '=', 'accesorios.id_marca')
        ->leftJoin('marcas as mar3', 'mar3.id', '=', 'telefonos.id_marca')
        ->select('empleados.nombre as empleado_nombre',
            DB::raw('GROUP_CONCAT(DISTINCT cpu_equipos.id SEPARATOR ", ") as cpu_id'),
            DB::raw('GROUP_CONCAT(categorias.nombre SEPARATOR ", ") as cpu_categoria'),
            DB::raw('GROUP_CONCAT(marcas.marca SEPARATOR ", ") as cpu_marca'),
            DB::raw('GROUP_CONCAT(DISTINCT cpu_equipos.serie SEPARATOR ", ") as cpu_serie'),
            DB::raw('GROUP_CONCAT(DISTINCT cpu_equipos.n_serial SEPARATOR ", ") as cpu_serial'),
            DB::raw('GROUP_CONCAT(DISTINCT cpu_equipos.n_activo SEPARATOR ", ") as n_activo'),
            DB::raw('GROUP_CONCAT(DISTINCT accesorios.id SEPARATOR ", ") as accesorio_id'),
            DB::raw('GROUP_CONCAT(cat2.nombre SEPARATOR ", ") as accesorio_categoria'),
            DB::raw('GROUP_CONCAT(mar2.marca SEPARATOR ", ") as accesorio_marca'),
            DB::raw('GROUP_CONCAT(DISTINCT accesorios.n_serial SEPARATOR ", ") as accesorio_n_serial'),
            DB::raw('GROUP_CONCAT(DISTINCT accesorios.serie SEPARATOR ", ") as accesorio_serie'),
            DB::raw('GROUP_CONCAT(DISTINCT telefonos.id SEPARATOR ", ") as telefono_id'),
            DB::raw('GROUP_CONCAT(cat3.nombre SEPARATOR ", ") as telefono_categoria'),
            DB::raw('GROUP_CONCAT(mar3.marca SEPARATOR ", ") as telefono_marca'),
            DB::raw('GROUP_CONCAT(DISTINCT telefonos.modelo SEPARATOR ", ") as telefono_modelo'),
            DB::raw('GROUP_CONCAT(DISTINCT telefonos.serial SEPARATOR ", ") as telefono_serial'))
        ->where('empleados.id', '=', $id_empleado)
        ->groupBy('empleados.nombre')
        ->get();
    
    $memorandos = Memorando::where('id', $id_memorando)->get();
    $encargado = DB::table('encargados')->where('id', 1)->first();
    $pdf = Pdf::loadView('memorando.pdf', compact('resultados', 'memorandos', 'fechaActual', 'encargado'));
    return $pdf->stream('Memorando.pdf');
    
    }
    
    
    
}

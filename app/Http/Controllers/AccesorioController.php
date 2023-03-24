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


class AccesorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accesorios = Accesorio::all();
        return view('accesorio.index')->with('accesorios', $accesorios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::whereIn('nombre', ['DIADEMA', 'MOUSE', 'MONITOR', 'TECLADO', 'TERMINAL', 'IMPRESORA', 'VIDEOPROYECTOR','SWITCH'])->get();
        $marcas =  DB::table('marcas')->orderBy('marca', 'asc')->get();
        $marcas_ordenadas = array();
        foreach ($marcas as $marca) {
            $marcas_ordenadas[$marca->id] = $marca->marca;
        };
        $empleados =  DB::table('empleados')->orderBy('nombre', 'asc')->get();
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
        $accesorio-> n_activo = $request->get('n_activo');
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
        $categoria = Categoria::whereIn('nombre', ['DIADEMA', 'MOUSE', 'MONITOR', 'TECLADO', 'TERMINAL', 'IMPRESORA', 'VIDEOPROYECTOR','SWITCH'])->get();
        $marca = Marca::all();
        $empleado = Empleado::all();
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
        $accesorio-> n_activo = $request->get('n_activo');
        $accesorio-> n_serial = $request->get('n_serial');
        $accesorio-> n_parte = $request->get('n_parte');
        $accesorio-> observaciones = $request->get('observaciones');
        $accesorio-> id_empleado = $request->get('id_empleado');

        $accesorio->save();

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CpuEquipo;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Empleado;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;



class CpuEquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipos = CpuEquipo::all();
        return view('equipo.index')->with('equipos', $equipos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::whereIn('nombre', ['CPU', 'PORTATIL', 'ALL-IN-ONE'])->get();

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
        return view('equipo.create', compact('categorias', 'marcas_ordenadas', 'empleados_ordenados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $equipos = new CpuEquipo();
        $equipos->id_categoria = $request->get('id_categoria');
        $equipos->id_marca = $request->get('id_marca');
        $equipos->serie = $request->get('serie');
        $equipos->n_activo = $request->get('n_activo');
        $equipos->n_serial = $request->get('n_serial');
        $equipos->n_parte = $request->get('n_parte');
        $equipos->memoria_ram = $request->get('memoria_ram');
        $equipos->procesador = $request->get('procesador');
        $equipos->discoduro = $request->get('discoduro');
        $equipos->observaciones = $request->get('observaciones');
        $equipos->id_empleado = $request->get('id_empleado');
        $equipos->nom_equipo = $request->get('nom_equipo');


        $equipos->save();

        return redirect('/equipos');
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
        $equipo = CpuEquipo::find($id);
        $categoria = Categoria::whereIn('nombre', ['CPU', 'PORTATIL', 'ALL-IN-ONE'])->get();
        $marca = Marca::all();
        $empleado = Empleado::all();
        return view('equipo.edit', compact('equipo', 'categoria', 'marca', 'empleado'));
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
        $equipo = CpuEquipo::find($id);
        $equipo->id_categoria = $request->input('id_categoria');
        $equipo->id_marca = $request->input('id_marca');
        $equipo->serie = $request->input('serie');
        $equipo->n_activo = $request->input('n_activo');
        $equipo->n_serial = $request->input('n_serial');
        $equipo->n_parte = $request->input('n_parte');
        $equipo->memoria_ram = $request->input('memoria_ram');
        $equipo->procesador = $request->input('procesador');
        $equipo->discoduro = $request->input('discoduro');
        $equipo->observaciones = $request->input('observaciones');
        $equipo->id_empleado = $request->input('id_empleado');
        $equipo->nom_equipo = $request->input('nom_equipo');

        $equipo->save();
        CpuEquipo::actualizarHistorial($id, $request->get('id_empleado'));
        

        return redirect('/equipos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipo = CpuEquipo::find($id);
        $equipo->delete();
        return redirect('/equipos');
    }

    public function pdf($id)
    {
        $fechaActual = Carbon::now()->format('d/m/Y');
        $equipos = CpuEquipo::where('id', $id)->get();

        $pdf = Pdf::loadView('equipo.pdf', compact('equipos', 'fechaActual'));
        return $pdf->stream('Responsabilidad_equipos.pdf');
    }
    
}

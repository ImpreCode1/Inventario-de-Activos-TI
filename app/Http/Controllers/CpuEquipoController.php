<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CpuEquipo;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Empleado;

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
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $empleados = Empleado::all();
        return view('equipo.create', compact('categorias', 'marcas', 'empleados'));    
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
        $equipos-> id_categoria = $request->get('id_categoria');
        $equipos-> id_marca = $request->get('id_marca');
        $equipos-> serie = $request->get('serie');
        $equipos-> n_activo = $request->get('n_activo');
        $equipos-> n_serial = $request->get('n_serial');
        $equipos-> n_parte = $request->get('n_parte');
        $equipos-> memoria_ram = $request->get('memoria_ram');
        $equipos-> procesador = $request->get('procesador');
        $equipos-> discoduro = $request->get('discoduro');
        $equipos-> observaciones = $request->get('observaciones');
        $equipos-> id_empleado = $request->get('id_empleado');
        $equipos-> nom_equipo = $request->get('nom_equipo');


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
        $categoria = Categoria::all();
        $marca = Marca::all();
        $empleado = Empleado::all();
        return view('equipo.edit', compact( 'equipo', 'categoria', 'marca', 'empleado'));
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
        $equipo-> id_categoria = $request->get('id_categoria');
        $equipo-> id_marca = $request->get('id_marca');
        $equipo-> serie = $request->get('serie');
        $equipo-> n_activo = $request->get('n_activo');
        $equipo-> n_serial = $request->get('n_serial');
        $equipo-> n_parte = $request->get('n_parte');
        $equipo-> memoria_ram = $request->get('memoria_ram');
        $equipo-> procesador = $request->get('procesador');
        $equipo-> discoduro = $request->get('discoduro');
        $equipo-> observaciones = $request->get('observaciones');
        $equipo-> id_empleado = $request->get('id_empleado');
        $equipo-> nom_equipo = $request->get('nom_equipo');

        $equipo->save();

        return redirect('/empleados');
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
}

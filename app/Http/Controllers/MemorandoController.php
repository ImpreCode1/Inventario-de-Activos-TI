<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memorando;
use Illuminate\Support\Facades\DB;

class MemorandoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Memorando.index');
    }

    public function memorandos(){
        $memorandos = Memorando::with(['empleado'])->select('id', 'id_empleado', 'ciudad', 'direccion', 'n_contacto')->get();
        return datatables()->of($memorandos)->toJson();
    }   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $empleados =  DB::table('empleados')
        ->where('id', '<>', 0) // excluye el empleado con id 0
        ->orderBy('nombre', 'asc')
        ->get();
        $empleados_ordenados = [];
        foreach ($empleados as $empleado) {
        $empleados_ordenados[$empleado->id] = $empleado->nombre;
        }
        return view('memorando.create', compact('empleados_ordenados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $memorandos = new Memorando();
        $memorandos -> id_empleado = $request->input('id_empleado');
        $memorandos -> ciudad = $request->input('ciudad');
        $memorandos -> direccion = $request->input('direccion');
        $memorandos -> n_contacto = $request->input('n_contacto');
        $memorandos->save();
        return redirect('/memorandos');
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
        //
    }
}

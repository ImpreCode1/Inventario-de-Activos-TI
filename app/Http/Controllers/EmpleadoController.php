<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Cargo;
use App\Models\ModoUsuario;
use App\Models\Departamento;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::all();
        return view('empleado.index')->with('empleados', $empleados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cargos = Cargo::all();
        $departamentos = Departamento::all();
        $modoUsuarios = ModoUsuario::all();
        
        return view('empleado.create', compact('cargos', 'departamentos', 'modoUsuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleados = new Empleado();
        $empleados-> nombre = $request->get('nombre');
        $empleados-> id_cargo = $request->get('id_cargo');
        $empleados-> id_depto = $request->get('id_depto');
        $empleados-> clave_tel = $request->get('clave_tel');
        $empleados-> num_exten = $request->get('num_exten');
        $empleados-> retirado = $request->get('retirado');
        $empleados-> usu_dominio = $request->get('usu_dominio');
        $empleados-> clave_dominio = $request->get('clave_dominio');
        $empleados-> email = $request->get('email');
        $empleados-> nom_usu = $request->get('nom_usu');
        $empleados-> clave_usu = $request->get('clave_usu');
        $empleados-> id_modo_usuario = $request->get('id_modo_usuario');

        $empleados->save();

        return redirect('/empleados');
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
        $empleado = Empleado::find($id);
        return view('empleado.edit')->with('empleado',$empleado);
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

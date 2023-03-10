<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Telefono;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Empleado;

class TelefonoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $celulares = Telefono::all();
        return view('celular.index')->with('celulares', $celulares);
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
        return view('celular.create', compact('categorias', 'marcas', 'empleados')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $telefono = new Telefono();
        $telefono-> id_categoria = $request->get('id_categoria');
        $telefono-> id_marca = $request->get('id_marca');
        $telefono-> modelo = $request->get('modelo');
        $telefono-> n_telefono = $request->get('n_telefono');
        $telefono-> email_1 = $request->get('email_1');
        $telefono-> email_2 = $request->get('email_2');
        $telefono-> serial_sim = $request->get('serial_sim');
        $telefono-> ram = $request->get('ram');
        $telefono-> rom = $request->get('rom');
        $telefono-> observaciones = $request->get('observaciones');
        $telefono-> id_empleado = $request->get('id_empleado');

        $telefono->save();

        return redirect('/celulares');
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

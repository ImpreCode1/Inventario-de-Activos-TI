<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Telefono;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Empleado;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

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
        $celular = new Telefono();
        $celular-> id_categoria = $request->get('id_categoria');
        $celular-> id_marca = $request->get('id_marca');
        $celular-> modelo = $request->get('modelo');
        $celular-> n_telefono = $request->get('n_telefono');
        $celular-> email_1 = $request->get('email_1');
        $celular-> email_2 = $request->get('email_2');
        $celular-> serial_sim = $request->get('serial_sim');
        $celular-> ram = $request->get('ram');
        $celular-> rom = $request->get('rom');
        $celular-> observaciones = $request->get('observaciones');
        $celular-> id_empleado = $request->get('id_empleado');

        $celular->save();

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
        $celular = Telefono::find($id);
        $categoria = Categoria::all();
        $marca = Marca::all();
        $empleado = Empleado::all();
        return view('celular.edit', compact( 'celular', 'categoria', 'marca', 'empleado'));
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
        $celular = Telefono::find($id);
        $celular-> id_categoria = $request->get('id_categoria');
        $celular-> id_marca = $request->get('id_marca');
        $celular-> modelo = $request->get('modelo');
        $celular-> n_telefono = $request->get('n_telefono');
        $celular-> email_1 = $request->get('email_1');
        $celular-> email_2 = $request->get('email_2');
        $celular-> serial_sim = $request->get('serial_sim');
        $celular-> ram = $request->get('ram');
        $celular-> rom = $request->get('rom');
        $celular-> observaciones = $request->get('observaciones');
        $celular-> id_empleado = $request->get('id_empleado');

        $celular->save();

        return redirect('/celulares');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $celular = Telefono::find($id);
        $celular->delete();
        return redirect('/celulares');
    }

    public function pdf($id)
    {
        $fechaActual = Carbon::now()->format('d/m/Y');
        $celulares = Telefono::where('id', $id)->get();

        $pdf = Pdf::loadView('celular.pdf', compact('celulares', 'fechaActual'));
        return $pdf->stream('Responsabilidad_equipos.pdf');
    }
    
}

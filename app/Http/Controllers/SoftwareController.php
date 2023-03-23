<?php

namespace App\Http\Controllers;

use App\Models\Software;
use Illuminate\Http\Request;
use App\Models\Empleado;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $softwares = Software::all();
        return view('Software.index')->with('softwares', $softwares);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados = Empleado::all();
        return view('software.create', compact('empleados'));  

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $softwares = new Software();
        $softwares -> id_empleado = $request->get('id_empleado');

        $softwares->save();

        return redirect('/softwares');
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
        $software = Software::find($id);
        $empleado = Empleado::all();
        return view('software.edit', compact( 'software', 'empleado'));
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
        $software = Software::find($id);
        $software-> id_empleado = $request->get('id_empleado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $software = Software::find($id);
        $software->delete();
        return redirect('/softwares');
    }

    public function pdf($id)
    {
        $fechaActual = Carbon::now()->format('d/m/Y');
        $softwares = Software::where('id', $id)->get();

        $pdf = Pdf::loadView('software.pdf', compact('softwares', 'fechaActual'));
        return $pdf->stream('Responsabilidad_equipos.pdf');
    }
    
}

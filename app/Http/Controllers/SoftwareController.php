<?php

namespace App\Http\Controllers;

use App\Models\Software;
use Illuminate\Http\Request;
use App\Models\Empleado;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('Software.index');
    }

    public function softwares(){
        $softwares = Software::with(['empleado'])->select('id', 'id_empleado', 'created_at')->get();
        return datatables()->of($softwares)
            ->addColumn('created_at', function ($software) {
                return $software->created_at->format('Y-m-d');
            })
            ->addColumn('action', function ($software) {
                return '
                <form id="form-eliminar-' . $software->id . '" action="' . route('softwares.destroy', $software->id) . '" method="POST">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('.$software->id.')">Eliminar</button>
                        <a href="/softwares/' . $software->id . '/pdf" target="_blank" class="btn btn-success btn-sm">Responsabilidad Software</a>
                    </form>
                ';
            })
            ->rawColumns(['action'])
            ->toJson();
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados =  DB::table('empleados')->orderBy('nombre', 'asc')->get();
        $empleados_ordenados = array();
        foreach ($empleados as $empleado) {
            $empleados_ordenados[$empleado->id] = $empleado->nombre;
        };
        return view('software.create', compact('empleados_ordenados'));  

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

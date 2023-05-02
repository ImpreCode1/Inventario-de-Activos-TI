<?php

namespace App\Http\Controllers;

use App\Models\HistorialEquipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class HistorialEquipoController extends Controller
{
    function __construct()
{
    $this->middleware('permission:ver-HistorialEquipo|borrar-HistorialEquipo')->only('index');
    $this->middleware('permission:borrar-HistorialEquipo', ['only'=>['destroy']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('HistorialEquipo.index');
    }

    public function historialEquipos(){
        $equiposHistorial = HistorialEquipo::with(['empleado', 'cpuequipo.categoria'])->select('id', 'id_empleado', 'id_portatiles', 'fecha_asignacion', 'fecha_devolucion')->get();
        return datatables()->of($equiposHistorial)
        ->addColumn('action', function ($equipo) {
            $html = '';
            if (Gate::allows('borrar-HistorialEquipo', $equipo)) {
                $html .= '<form id="form-eliminar-' . $equipo->id . '" action="'. route('equiposHistorial.destroy', $equipo->id) .'" method="POST" style="display: inline-block;">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $equipo->id . ')">Eliminar</button>
                </form>';
            }
            return $html;
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $equipo = HistorialEquipo::find($id);
        $equipo->delete();
        return redirect('/equiposHistorial');
    }
}

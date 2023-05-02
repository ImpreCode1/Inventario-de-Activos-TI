<?php

namespace App\Http\Controllers;

use App\Models\HistorialAccesorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class HistorialAccesorioController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-HistorialAccesesorio|borrar-HistorialAccesesorio')->only('index');
        $this->middleware('permission:borrar-HistorialAccesesorio', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('HistorialAccesesorio.index');
    }

    public function historialaccesesorio()
{
    $historialAccesesorio = HistorialAccesorio::with(['empleado', 'accesesorio.categoria'])
        ->select('id','id_empleado', 'id_accesorio', 'fecha_asignacion', 'fecha_devolucion')->get();
    return datatables()->of($historialAccesesorio)
        ->addColumn('action', function ($historial) {
            $html = '';
            if (Gate::allows('borrar-HistorialAccesesorio', $historial)) {
                $html .= '<form id="form-eliminar-' . $historial->id . '" action="'. route('accesesoriosHistorial.destroy', $historial->id) .'" method="POST" style="display: inline-block;">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $historial->id . ')">Eliminar</button>
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
        //
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
        $accesesorio = HistorialAccesorio::find($id);
        $accesesorio->delete();
        return redirect('/accesesoriosHistorial');
    }
}

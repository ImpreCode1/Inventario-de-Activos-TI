<?php

namespace App\Http\Controllers;

use App\Models\HistorialTelefono;
use App\Models\Telefono;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class HistorialTelefonoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-HistorialTelefono|borrar-HistorialTelefono')->only('index');
        $this->middleware('permission:borrar-HistorialTelefono', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('HistorialTelefono.index');
    }

    public function historialTelefonos(){
        $telefonosHistorial = HistorialTelefono::with(['empleado', 'telefono'])->select('id', 'id_empleado', 'id_telefonos', 'fecha_asignacion', 'fecha_devolucion')->get();
        return datatables()->of($telefonosHistorial)
        ->addColumn('action', function ($telefono) {
            $html = '';
            if (Gate::allows('borrar-HistorialTelefono', $telefono)) {
                $html .= '<form id="form-eliminar-' . $telefono->id . '" action="'. route('telefonosHistorial.destroy', $telefono->id) .'" method="POST" style="display: inline-block;">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $telefono->id . ')">Eliminar</button>
                </form>';
            }
            return $html;
        })
        ->rawColumns(['action'])->toJson();

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
        $telefono = HistorialTelefono::find($id);
        $telefono->delete();
        return redirect('/telefonosHistorial');
    }
}

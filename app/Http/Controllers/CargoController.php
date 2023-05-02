<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use Illuminate\Support\Facades\Gate;




class CargoController extends Controller
{

    
function __construct()
{
    $this->middleware('permission:ver-cargo|crear-cargo|editar-cargo|borrar-cargo')->only('index');
    $this->middleware('permission:crear-cargo', ['only'=>['create', 'store']]);
    $this->middleware('permission:editar-cargo', ['only'=>['edit', 'update']]);
    $this->middleware('permission:borrar-cargo', ['only'=>['destroy']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cargo.index');
    }

    public function datos(){
        $cargos = Cargo::select('id', 'nombre', 'detalle')->get();
        return datatables()->of($cargos)->addColumn('acciones', function($cargo){
            $html = '';
            if (Gate::allows('editar-cargo', $cargo)) {
                $html .= '<a href="/cargos/'.$cargo->id.'/edit" class="btn btn-info btn-sm">Editar</a>';
            }
            if (Gate::allows('borrar-cargo', $cargo)) {
                $html .= '<form id="form-eliminar-' . $cargo->id . '" action="'. route('cargos.destroy', $cargo->id) .'" method="POST" style="display: inline-block;">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $cargo->id . ')">Eliminar</button>
                </form>';
            }
            return $html;
        })->rawColumns(['acciones'])->toJson();
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cargo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cargos = new Cargo();
        $cargos-> nombre = $request->get('nombre');
        $cargos-> detalle = $request->get('detalle');

        $cargos->save();

        return redirect('/cargos');
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
        $cargo = Cargo::find($id);
        return view('cargo.edit')->with('cargo',$cargo);
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
        $cargo = Cargo::find($id);
        $cargo-> nombre = $request->get('nombre');
        $cargo-> detalle = $request->get('detalle');

        $cargo->save();

        return redirect('/cargos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cargo = Cargo::find($id);
        $cargo->delete();
        return redirect('/cargos');
    }
}

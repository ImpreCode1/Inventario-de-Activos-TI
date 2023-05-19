<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class MarcaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-marca|crear-marca|editar-marca|borrar-marca')->only('index');
        $this->middleware('permission:crear-marca', ['only'=>['create', 'store']]);
        $this->middleware('permission:editar-marca', ['only'=>['edit', 'update']]);
        $this->middleware('permission:borrar-marca', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('marca.index');

    }
    public function marcas(){

        if (Gate::denies('ver-marca')) {
            abort(403); // Acceso no autorizado
        }
        $marcas = Marca::select('id', 'marca')->get();
        return datatables()->of($marcas)
            ->addColumn('acciones', function ($marca) {
                $html = '';
                if (Gate::allows('editar-departamento', $marca)) {
                    $html .= '<a href="/marcas/'.$marca->id.'/edit" class="btn btn-info btn-sm">Editar</a>';
                }
                if (Gate::allows('borrar-departamento', $marca)) {
                    $html .= '<form id="form-eliminar-' . $marca->id . '" action="'. route('marcas.destroy', $marca->id) .'" method="POST" style="display: inline-block;">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $marca->id . ')">Eliminar</button>
                    </form>';
                }
                return $html;
            })
            ->rawColumns(['acciones'])
            ->toJson();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marca.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $marcas = new Marca();
        $marcas-> marca = $request->get('marca');

        $marcas->save();

        return redirect('/marcas');
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
        $marca = Marca::find($id);
        return view('marca.edit')->with('marca',$marca);
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
        $marca = Marca::find($id);
        $marca-> marca = $request->get('marca');

        $marca->save();

        return redirect('/marcas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marca = Marca::find($id);
        $marca->delete();
        return redirect('/marcas');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
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
        $marcas = Marca::select('id', 'marca')->get();
        return datatables()->of($marcas)
            ->addColumn('acciones', function ($marca) {
                return '<td>
                            <form action="'.route('marcas.destroy', $marca->id).'" method="POST" id="form-eliminar-'.$marca->id.'">
                                <a href="/marcas/'.$marca->id.'/edit" class="btn btn-info btn-sm">Editar</a>
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('.$marca->id.')">Eliminar</button>
                            </form>
                        </td>';
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

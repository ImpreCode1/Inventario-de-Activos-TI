<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use Illuminate\Support\Facades\Gate;


class DepartamentoController extends Controller
{

    function __construct()
{
    $this->middleware('permission:ver-departamento|crear-departamento|editar-departamento|borrar-departamento')->only('index');
    $this->middleware('permission:crear-departamento', ['only'=>['create', 'store']]);
    $this->middleware('permission:editar-departamento', ['only'=>['edit', 'update']]);
    $this->middleware('permission:borrar-departamento', ['only'=>['destroy']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('departamento.index');
    }

    public function departamentos()
    {
        if (Gate::denies('ver-departamento')) {
            abort(403); // Acceso no autorizado
        }
        
        $departamentos = Departamento::select('id', 'nombre')->get();
        return datatables()->of($departamentos)
            ->addColumn('action', function ($departamento) {
                $html = '<div class="d-flex justify-content-center align-items-center flex-wrap action-buttons">';
                if (Gate::allows('editar-departamento', $departamento)) {
                    $html .= '<a href="/departamentos/'.$departamento->id.'/edit" 
                    class="btn-icon btn-outline-primary"
                    title="Editar">
                    <i class="fas fa-pen"></i>
                    </a>';
                }
                if (Gate::allows('borrar-departamento', $departamento)) {
                    $html .= '<form id="form-eliminar-' . $departamento->id . '" action="'. route('departamentos.destroy', $departamento->id) .'" method="POST" style="display: inline;">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="button" class="btn-icon btn-outline-danger" 
                        title ="Eliminar"
                        onclick="confirmDelete(' . $departamento->id . ')">
                        <i class="fas fa-trash"></i>
                        </button>
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
        return view('departamento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departamentos = new Departamento();
        $departamentos->nombre = $request->get('nombre');

        $departamentos->save();

        return redirect('/departamentos');
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
        $departamento = Departamento::find($id);
        return view('departamento.edit')->with('departamento', $departamento);
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
        $departamento = Departamento::find($id);
        $departamento->nombre = $request->get('nombre');

        $departamento->save();

        return redirect('/departamentos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departamento = Departamento::find($id);
        $departamento->delete();
        return redirect('/departamentos');
    }
}

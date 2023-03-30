<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Cargo;
use App\Models\ModoUsuario;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;




class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('empleado.index');
        // return view('empleado.index')->with('empleados', $empleados);
    }

    public function empleados(){
        $empleados = Empleado::with(['departamentos', 'cargos'])->select('id', 'nombre', 'usu_dominio', 'num_exten', 'email', 'id_cargo', 'id_depto')->where('id', '<>', 0)->get();
        return datatables()->of($empleados)
        ->addColumn('acciones', function ($empleado) {
            return '
            <form id="form-eliminar-' . $empleado->id . '" action="' . route('empleados.destroy', $empleado->id) . '" method="POST">
                <a href="/empleados/' . $empleado->id . '/edit" class="btn btn-info btn-sm">Editar</a>
                <a href="/empleados/' . $empleado->id . '/pdf" target="_blank" class="btn btn-success btn-sm">Act contraseñas</a>
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $empleado->id . ')">Eliminar</button>
            </form>';
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
        $cargos =  DB::table('cargos')->orderBy('nombre', 'asc')->get();
        $cargos_ordenados = array();
        foreach ($cargos as $cargo) {
            $cargos_ordenados[$cargo->id] = $cargo->nombre;
        };

        $departamentos = DB::table('departamentos')->orderBy('nombre', 'asc')->get();
        $departamentos_ordenados = array();
        foreach ($departamentos as $departamento) {
            $departamentos_ordenados[$departamento->id] = $departamento->nombre;
        };


        $modoUsuarios = ModoUsuario::all();
        return view('empleado.create', compact('cargos_ordenados', 'departamentos_ordenados', 'modoUsuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $empleados = new Empleado();
        $empleados-> nombre = $request->input('nombre');
        $empleados-> id_cargo = $request->input('id_cargo');
        $empleados-> id_depto = $request->input('id_depto');
        $empleados-> num_exten = $request->input('num_exten');
        $empleados-> retirado = $request->input('retirado');
        $empleados-> usu_dominio = $request->input('usu_dominio'); 
        $password = str::random(10);
        $empleados-> clave_dominio = $password;
        $empleados-> email = $request->input('usu_dominio') . '@impresistem.com';
        $empleados-> id_modo_usuario = $request->input('id_modo_usuario');

        $empleados->save();

        return redirect('/empleados');
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
        $empleado = Empleado::find($id);
        $cargo = Cargo::all();
        $departamento = Departamento::all();
        $modoUsuario = ModoUsuario::all();
        return view('empleado.edit', compact( 'empleado', 'cargo', 'departamento', 'modoUsuario'));
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
        $empleado = Empleado::find($id);
        $empleado-> nombre = $request->get('nombre');
        $empleado-> id_cargo = $request->get('id_cargo');
        $empleado-> id_depto = $request->get('id_depto');
        $empleado-> num_exten = $request->get('num_exten');
        $empleado-> retirado = $request->get('retirado');
        $empleado-> usu_dominio = $request->get('usu_dominio');
        $empleado-> clave_dominio = $request->get('clave_dominio');
        $empleado-> email = $request->get('email');
        $empleado-> id_modo_usuario = $request->get('id_modo_usuario');

        $empleado->save();

        return redirect('/empleados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        $empleado->delete();
        return redirect('/empleados');
    }

    public function pdf($id){
        $empleados =  Empleado::where('id', $id)->get();

        $pdf = Pdf::loadView('empleado.pdf', compact('empleados'));
        return $pdf->setPaper('a4', 'landscape')-> stream('Acta_contraseñas.pdf');
    }
}

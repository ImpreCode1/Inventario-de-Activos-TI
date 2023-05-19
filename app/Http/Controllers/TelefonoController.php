<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Telefono;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Empleado;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class TelefonoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-telefono|crear-telefono|editar-telefono|borrar-telefono|pdf-telefono')->only('index');
        $this->middleware('permission:crear-telefono', ['only'=>['create', 'store']]);
        $this->middleware('permission:editar-telefono', ['only'=>['edit', 'update']]);
        $this->middleware('permission:borrar-telefono', ['only'=>['destroy']]);
        $this->middleware('permission:pdf-telefono', ['only'=>['pdf']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('celular.index');
    }

    public function celulares(){
        if (Gate::denies('ver-software')) {
            abort(403); // Acceso no autorizado
        }
        $celulares = Telefono::with(['categoria', 'marca', 'empleado'])->select('id', 'id_empleado', 'id_categoria', 
        'id_marca', 'serial', 'modelo', 'n_telefono', 'email_1', 'email_2', 'serial_sim', 'ram', 'rom')->get();
        return datatables()->of($celulares)
        ->addColumn('action', function ($celulares) {
            $html = '';
            if (Gate::allows('editar-telefono', $celulares)) {
                $html .= '<a href="/celulares/'.$celulares->id.'/edit" class="btn btn-info btn-sm">Editar</a>';
            }
            if (Gate::allows('pdf-telefono', $celulares)) {
                $html .= '<a href="/celulares/' . $celulares->id . '/pdf" target="_blank" class="btn btn-success btn-sm">Responsabilidad Usu</a>';
            }
            if (Gate::allows('borrar-telefono', $celulares)) {
                $html .= '<form id="form-eliminar-' . $celulares->id . '" action="'. route('celulares.destroy', $celulares->id) .'" method="POST" style="display: inline-block;">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(' . $celulares->id . ')">Eliminar</button>
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
        $categorias = Categoria::whereIn('nombre', ['CELULAR'])->get();
        $marcas =  DB::table('marcas')->orderBy('marca', 'asc')->get();
        $marcas_ordenadas = array();
        foreach ($marcas as $marca) {
            $marcas_ordenadas[$marca->id] = $marca->marca;
        };
        $empleados =  DB::table('empleados')->orderByRaw("CASE WHEN id=0 THEN 0 ELSE 1 END, nombre ASC")->get();
        $empleados_ordenados = array();
        foreach ($empleados as $empleado) {
            $empleados_ordenados[$empleado->id] = $empleado->nombre;
        };
        return view('celular.create', compact('categorias', 'marcas_ordenadas', 'empleados_ordenados')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $celular = new Telefono();
        $celular-> id_categoria = $request->get('id_categoria');
        $celular-> id_marca = $request->get('id_marca');
        $celular-> serial = $request->get('serial');
        $celular-> modelo = $request->get('modelo');
        $celular-> n_telefono = $request->get('n_telefono');
        $celular-> email_1 = $request->get('email_1');
        $celular-> email_2 = $request->get('email_2');
        $celular-> serial_sim = $request->get('serial_sim');
        $celular-> ram = $request->get('ram');
        $celular-> rom = $request->get('rom');
        $celular-> observaciones = $request->get('observaciones');
        $celular-> id_empleado = $request->get('id_empleado');

        $celular->save();

        return redirect('/celulares');
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
        $celular = Telefono::find($id);
        $categoria = Categoria::whereIn('nombre', ['CELULAR'])->get();
        $marca = Marca::orderBy('marca', 'asc')->get();
        $empleado =  DB::table('empleados')->orderByRaw("CASE WHEN id=0 THEN 0 ELSE 1 END, nombre ASC")->get();
        return view('celular.edit', compact( 'celular', 'categoria', 'marca', 'empleado'));
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
        $celular = Telefono::find($id);
        $celular->id_categoria = $request->input('id_categoria');
        $celular->id_marca = $request->input('id_marca');
        $celular->serial = $request->input('serial');
        $celular->modelo = $request->input('modelo');
        $celular->n_telefono = $request->input('n_telefono');
        $celular->email_1 = $request->input('email_1');
        $celular->email_2 = $request->input('email_2');
        $celular->serial_sim = $request->input('serial_sim');
        $celular->ram = $request->input('ram');
        $celular->rom = $request->input('rom');
        $celular->observaciones = $request->input('observaciones');
        $celular->id_empleado = $request->input('id_empleado');


        $celular->save();
        if ($request->input('id_empleado') == 0) {
            $celular->setEstadoDisponible();
        } else {
            Telefono::actualizarTelefono($id, $request->get('id_empleado'));
        }        
        return redirect('/celulares');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $celular = Telefono::find($id);
        $celular->delete();
        return redirect('/celulares');
    }

    public function pdf($id)
    {
        $fechaActual = Carbon::now()->format('d/m/Y');
        $celulares = Telefono::where('id', $id)->get();

        $pdf = Pdf::loadView('celular.pdf', compact('celulares', 'fechaActual'));
        return $pdf->stream('Responsabilidad_equipos.pdf');
    }
    
}

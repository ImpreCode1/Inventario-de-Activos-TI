<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CpuEquipo;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Empleado;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Destinatario;
use App\Mail\CambioEquipo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class CpuEquipoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-equipo|crear-equipo|editar-equipo|borrar-equipo|pdf-equipo')->only('index');
        $this->middleware('permission:crear-equipo', ['only'=>['create', 'store', 'updateDestinatario']]);
        $this->middleware('permission:editar-equipo', ['only'=>['edit', 'update']]);
        $this->middleware('permission:borrar-equipo', ['only'=>['destroy']]);
        $this->middleware('permission:pdf-equipo', ['only'=>['pdf']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinatario = Destinatario::findOrFail(1); // Obtener el correo destinatario con id 1
        return view('equipo.index')->with('destinatario', $destinatario);
    }

    public function equipos(){

        if (Gate::denies('ver-equipo')) {
            abort(403); // Acceso no autorizado
        }
        $equipos = CpuEquipo::with(['marca', 'categoria', 'empleado'])->select('id','id_empleado' ,'id_categoria', 
        'id_marca', 'n_activo', 'costo', 'n_serial', 'serie', 'n_parte', 'memoria_ram', 'procesador', 'discoduro')->get();
        return datatables()->of($equipos)
            ->addColumn('action', function ($equipo) {
            $html = '<div class="d-flex justify-content-center align-items-center flex-wrap action-buttons">';

            if (Gate::allows('editar-equipo', $equipo)) {
                $html .= '
                <a href="/equipos/'.$equipo->id.'/edit"
                class="btn-icon btn-outline-primary"
                title="Editar">
                    <i class="fas fa-pen"></i>
                </a>';
            }

            if (Gate::allows('pdf-equipo', $equipo)) {
                $html .= '
                <a href="/equipos/' . $equipo->id . '/pdf" target="_blank"
                class="btn-icon btn-outline-success"
                title="R.D.U">
                    <i class="fas fa-file-pdf"></i>
                </a>';
            }

            if (Gate::allows('borrar-equipo', $equipo)) {
                $html .= '
                <form id="form-eliminar-' . $equipo->id . '"
                    action="'. route('equipos.destroy', $equipo->id) .'"
                    method="POST" style="display:inline;">
                    '.csrf_field().method_field('DELETE').'
                    <button type="button"
                            class="btn-icon btn-outline-danger"
                            title="Eliminar"
                            onclick="confirmDelete(' . $equipo->id . ')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>';
            }

            $html .= '</div>';
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
        $categorias = Categoria::whereIn('nombre', ['CPU', 'PORTATIL', 'ALL-IN-ONE'])->get();

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
        return view('equipo.create', compact('categorias', 'marcas_ordenadas', 'empleados_ordenados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $equipos = new CpuEquipo();
    $equipos->id_categoria = $request->get('id_categoria');
    $equipos->id_marca = $request->get('id_marca');
    $equipos->serie = $request->get('serie');
    $equipos->n_activo = $request->get('n_activo');
    $equipos->costo = $request->get('costo');
    $equipos->n_serial = $request->get('n_serial');
    $equipos->n_parte = $request->get('n_parte');
    $equipos->memoria_ram = $request->get('memoria_ram');
    $equipos->procesador = $request->get('procesador');
    $equipos->discoduro = $request->get('discoduro');
    $equipos->observaciones = $request->get('observaciones');
    $equipos->id_empleado = $request->get('id_empleado');
    $equipos->nom_equipo = $request->get('nom_equipo');
    $equipos->save();

    $url_edicion = route('equipos.edit', ['equipo' => $equipos->id]);

    $destinatario = DB::table('destinatarios')->where('id', 1)->first();
    $correo = new CambioEquipo($equipos,  $url_edicion);
    try {
        Mail::to($destinatario->correo_notificacion)->send($correo);
    } catch (\Throwable $e) {
        Log::error('❌ Error al enviar correo: ' . $e->getMessage(), [
            'destinatario' => $destinatario->correo_notificacion,
            'contexto' => 'envío de notificación',
        ]);
    }

    return redirect('/equipos');
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
    $equipo = CpuEquipo::find($id);
    $categoria = Categoria::whereIn('nombre', ['CPU', 'PORTATIL', 'ALL-IN-ONE'])->get();
    $marca = Marca::orderBy('marca', 'asc')->get();
    $empleados =  DB::table('empleados')->orderByRaw("CASE WHEN id=0 THEN 0 ELSE 1 END, nombre ASC")->get();
    return view('equipo.edit', compact('equipo', 'categoria', 'marca', 'empleados'));
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
        $equipo = CpuEquipo::find($id);
        $equipo->id_categoria = $request->input('id_categoria');
        $equipo->id_marca = $request->input('id_marca');
        $equipo->serie = $request->input('serie');
        $equipo->n_activo = $request->input('n_activo');
        $equipo->costo = $request->input('costo');
        $equipo->n_serial = $request->input('n_serial');
        $equipo->n_parte = $request->input('n_parte');
        $equipo->memoria_ram = $request->input('memoria_ram');
        $equipo->procesador = $request->input('procesador');
        $equipo->discoduro = $request->input('discoduro');
        $equipo->observaciones = $request->input('observaciones');
        $equipo->id_empleado = $request->input('id_empleado');
        $equipo->nom_equipo = $request->input('nom_equipo');

        $equipo->save();

        if ($request->input('id_empleado') == 0) {
            $equipo->setEstadoDisponible();
        } else {
            CpuEquipo::actualizarHistorial($id, $request->get('id_empleado'));
        }        

        return redirect('/equipos');
    }

    public function updateDestinatario(Request $request, $id)
{
    $destinatario = Destinatario::find($id);
    $destinatario->correo_notificacion = $request->input('destinatario');
    $destinatario->save();

    return redirect('/equipos')->with('success', 'Destinatario actualizado exitosamente.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipo = CpuEquipo::find($id);
        $equipo->delete();
        return redirect('/equipos');
    }

    public function pdf($id)
    {
        $fechaActual = Carbon::now()->format('d/m/Y');
        $equipos = CpuEquipo::where('id', $id)->get();

        $pdf = Pdf::loadView('equipo.pdf', compact('equipos', 'fechaActual'));
        return $pdf->stream('Responsabilidad_equipos.pdf');
    }
    
}

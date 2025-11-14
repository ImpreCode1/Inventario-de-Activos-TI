<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PrestamoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-prestamo|crear-prestamo|editar-prestamo|borrar-prestamo|ver-HistorialEquipo')
            ->only('index');

        $this->middleware('permission:crear-prestamo', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-prestamo', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-prestamo', ['only' => ['destroy']]);
    }

    // ==========================================================
    //                VISTA PRINCIPAL (INDEX)
    // ==========================================================
    public function index()
    {
        return view('prestamos.index');
    }

    // ==========================================================
    //                LISTADO PARA DATATABLES
    // ==========================================================
    public function prestamos()
    {
        if (Gate::denies('ver-prestamo')) {
            abort(403);
        }

        $prestamos = Prestamo::with(['usuario', 'creador'])
            ->select('id', 'usuario_id', 'item_nombre', 'fecha_prestamo', 'fecha_devolucion', 'estado', 'creado_por')
            ->get();

        return datatables()->of($prestamos)
    ->addColumn('usuario', fn ($p) => $p->usuario->nombre ?? '---')

    ->editColumn('fecha_prestamo', fn ($p) => $p->fecha_prestamo ? \Carbon\Carbon::parse($p->fecha_prestamo)->format('d/m/Y') : '---'
    )

    ->editColumn('fecha_devolucion', fn ($p) => $p->fecha_devolucion ? \Carbon\Carbon::parse($p->fecha_devolucion)->format('d/m/Y') : '---'
    )

    ->addColumn('estado', function ($p) {
        $colores = [
            'Prestado' => '#f1c40f',   // Amarillo
            'Devuelto' => '#2ecc71',   // Verde
            'Perdido' => '#e74c3c',  // Rojo
        ];

        $color = $colores[$p->estado] ?? '#7f8c8d'; // Gris por defecto

        return '
        <span style="
            display:flex;
            align-items:center;
            gap:6px;
        ">
            <span style="
                width:10px;
                height:10px;
                border-radius:50%;
                background:'.$color.';
                display:inline-block;
            "></span>
            '.$p->estado.'
        </span>
    ';
    })

    ->addColumn('action', function ($prestamo) {
        $html = '<div class="d-flex justify-content-center align-items-center flex-wrap action-buttons">';

        // Si NO está devuelto, mostrar botón de editar
        if ($prestamo->estado !== 'Devuelto' && Gate::allows('editar-prestamo', $prestamo)) {
            $html .= '
        <a href="/prestamos/'.$prestamo->id.'/edit" 
            class="btn-icon btn-outline-primary" 
            title="Editar">
            <i class="fas fa-pen"></i>
        </a>';
        }

        // Si está prestado, mostrar botón de marcar como devuelto
        if ($prestamo->estado === 'Prestado' && Gate::allows('editar-prestamo')) {
            $html .= '
        <form action="/prestamos/'.$prestamo->id.'/devolver" 
                method="POST" style="display:inline-block;">
            '.csrf_field().'
            <button type="submit"
                    class="btn-icon btn-outline-success"
                    title="Marcar como devuelto">
                <i class="fas fa-check"></i>
            </button>
        </form>';
        }

        // Eliminar SIEMPRE
        if (Gate::allows('borrar-prestamo')) {
            $html .= '
        <form id="form-eliminar-'.$prestamo->id.'" 
            action="'.route('prestamos.destroy', $prestamo->id).'" 
            method="POST" style="display:inline;">
            '.csrf_field().method_field('DELETE').'
            <button type="button" 
                    class="btn-icon btn-outline-danger" 
                    title="Eliminar"
                    onclick="confirmDelete('.$prestamo->id.')">
                <i class="fas fa-trash"></i>
            </button>
        </form>';
        }

        $html .= '</div>';

        return $html;
    })

    ->rawColumns(['action', 'estado'])  // ✔ PERMITE HTML
    ->toJson();
    }

    // ==========================================================
    //                      CREAR PRÉSTAMO
    // ==========================================================
    public function create()
    {
        $empleados = Empleado::orderBy('nombre', 'asc')->get();

        return view('prestamos.create', compact('empleados'));
    }

    // ==========================================================
    //                      GUARDAR PRÉSTAMO
    // ==========================================================
    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:empleados,id',
            'item_nombre' => 'required|string|max:255',
            'fecha_prestamo' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);

        Prestamo::create([
            'usuario_id' => $request->usuario_id,
            'item_nombre' => $request->item_nombre,
            'fecha_prestamo' => $request->fecha_prestamo,
            'estado' => 'Prestado',
            'observaciones' => $request->observaciones,
            'creado_por' => auth()->id(),
        ]);

        return redirect('/prestamos');
    }

    // ==========================================================
    //                      EDITAR PRÉSTAMO
    // ==========================================================
    public function edit($id)
    {
        $prestamo = Prestamo::find($id);
        $empleados = Empleado::orderBy('nombre', 'asc')->get();

        return view('prestamos.edit', compact('prestamo', 'empleados'));
    }

    // ==========================================================
    //                      ACTUALIZAR PRÉSTAMO
    // ==========================================================
    public function update(Request $request, $id)
    {
        $prestamo = Prestamo::find($id);

        $prestamo->usuario_id = $request->usuario_id;
        $prestamo->item_nombre = $request->item_nombre;
        $prestamo->observaciones = $request->observaciones;
        $prestamo->fecha_prestamo = $request->fecha_prestamo;

        $prestamo->save();

        return redirect('/prestamos');
    }

    // ==========================================================
    //               MARCAR COMO DEVUELTO
    // ==========================================================
    public function devolver($id)
    {
        $prestamo = Prestamo::find($id);

        $prestamo->estado = 'Devuelto';
        $prestamo->fecha_devolucion = now();

        $prestamo->save();

        return redirect('/prestamos');
    }

    // ==========================================================
    //                      ELIMINAR PRÉSTAMO
    // ==========================================================
    public function destroy($id)
    {
        $prestamo = Prestamo::find($id);
        $prestamo->delete();

        return redirect('/prestamos');
    }
}

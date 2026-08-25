<?php

namespace App\Http\Controllers;

use App\Models\CpuEquipo;
use App\Models\EquipoHojaVida;
use App\Models\Telefono;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MantenimientosController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-HojasVida');
    }

    public function index()
    {
        return view('mantenimientos.index');
    }

    public function lista(Request $request)
    {
        if (Gate::denies('ver-HojasVida')) {
            abort(403);
        }

        $mantenimientos = EquipoHojaVida::query()
            ->where('evento', 'mantenimiento')
            ->with('usuario:id,name')
            ->when($request->filled('tipo'), function ($q) use ($request) {
                $q->where('equipo_tipo', $request->tipo);
            })
            ->when($request->filled('estado'), function ($q) use ($request) {
                $q->where('estado', $request->estado);
            })
            ->when($request->filled('fecha_desde'), function ($q) use ($request) {
                $q->whereDate('created_at', '>=', $request->fecha_desde);
            })
            ->when($request->filled('fecha_hasta'), function ($q) use ($request) {
                $q->whereDate('created_at', '<=', $request->fecha_hasta);
            })
            ->get();

        $cpus = CpuEquipo::select('id', 'n_activo', 'n_serial')->get()->keyBy('id');
        $telefonos = Telefono::select('id', 'serial')->get()->keyBy('id');

        return datatables()->of($mantenimientos)
            ->addColumn('equipo', function ($m) use ($cpus, $telefonos) {
                if ($m->equipo_tipo === 'cpu') {
                    $e = $cpus->get($m->equipo_id);

                    return $e ? ($e->n_activo ?: $e->n_serial) : '---';
                }

                $e = $telefonos->get($m->equipo_id);

                return $e ? $e->serial : '---';
            })
            ->addColumn('tipo', function ($m) {
                return ucfirst($m->equipo_tipo);
            })
            ->addColumn('estado_badge', function ($m) {
                $colores = [
                    'pendiente' => '#f1c40f',   // Amarillo
                    'en_progreso' => '#3498db', // Azul
                    'completado' => '#2ecc71',  // Verde
                    'cancelado' => '#7f8c8d',   // Gris neutro
                ];

                $color = $colores[$m->estado] ?? '#7f8c8d';

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
                    '.ucfirst(str_replace('_', ' ', $m->estado)).'
                </span>
            ';
            })
            ->editColumn('created_at', function ($m) {
                return $m->created_at ? $m->created_at->format('d/m/Y') : '---';
            })
            ->addColumn('usuario_nombre', function ($m) {
                return $m->usuario->name ?? '---';
            })
            ->addColumn('action', function ($m) {
                return '<a href="'.route('hojasvida.show', [$m->equipo_tipo, $m->equipo_id]).'"
                        class="btn-icon btn-outline-info"
                        title="Ver hoja de vida completa">
                        <i class="fas fa-eye"></i>
                    </a>';
            })
            ->rawColumns(['estado_badge', 'action'])
            ->toJson();
    }
}

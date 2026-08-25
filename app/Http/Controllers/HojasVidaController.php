<?php

namespace App\Http\Controllers;

use App\Models\CpuEquipo;
use App\Models\Empleado;
use App\Models\EquipoHojaVida;
use App\Models\EquipoHojaVidaAdjunto;
use App\Models\Telefono;
// <-- Asegurar el modelo correcto
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class HojasVidaController extends Controller
{
    public function show($tipo, $id)
    {
        $map = [
            'cpu' => CpuEquipo::class,
            'telefono' => Telefono::class,
        ];

        abort_if(!isset($map[$tipo]), 404);

        $modelo = $map[$tipo];

        $equipo = $modelo::with([
            'hojaVida.usuario',
            'hojaVida.adjuntos',
            'historialAsignaciones.empleado',
        ])->findOrFail($id);

        // 🔥 Unificación de todos los eventos
        $historial = collect();

        // Eventos técnicos
        foreach ($equipo->hojaVida as $item) {
            $historial->push((object) [
                'id' => $item->id,
                'fecha' => $item->created_at,
                'tipo' => 'tecnico',
                'evento' => strtoupper($item->evento),
                'descripcion' => $item->descripcion ?? 'Sin detalles',
                'estado' => $item->estado,
                'adjuntos' => $item->adjuntos,
                'usuario' => $item->usuario->name,
            ]);
        }

        // Asignaciones
        foreach ($equipo->historialAsignaciones as $asig) {
            $historial->push((object) [
                'id' => null,
                'fecha' => $asig->created_at, // ← ✔ CORRECTO
                'tipo' => 'asignacion',
                'evento' => 'ASIGNACIÓN',
                'descripcion' => 'Asignado a: '.$asig->empleado->nombre,
                'estado' => null,
                'adjuntos' => collect(),
                'usuario' => 'Sistema',
            ]);
        }

        // 🔥 Ordenar de más reciente a más antiguo
        $historial = $historial->sortByDesc('fecha')->values();

        return view('hojasvida.show', compact('equipo', 'tipo', 'historial'));
    }

    public function store(Request $request, $tipo, $id)
    {
        $request->validate([
            'evento' => 'required|string',
            'descripcion' => 'nullable|string',
            'estado' => ['required', Rule::in(['pendiente', 'en_progreso', 'completado', 'cancelado'])],
            'adjuntos' => 'nullable|array|max:5',
            'adjuntos.*' => 'file|mimes:pdf,jpg,jpeg,png,webp,doc,docx,xls,xlsx|max:10240',
        ]);

        abort_if(!in_array($tipo, ['cpu', 'telefono']), 404);
        $tipo === 'cpu'
            ? CpuEquipo::findOrFail($id)
            : Telefono::findOrFail($id);

        DB::transaction(function () use ($request, $tipo, $id, &$evento) {
            $evento = EquipoHojaVida::create([
                'equipo_id' => $id,
                'equipo_tipo' => $tipo,
                'evento' => $request->evento,
                'descripcion' => $request->descripcion,
                'estado' => $request->estado,
                'user_id' => auth()->id(),
            ]);

            foreach ($request->file('adjuntos', []) as $archivo) {
                $ruta = $archivo->store("hojasvida/{$tipo}/{$id}", 'public');

                EquipoHojaVidaAdjunto::create([
                    'hoja_vida_id' => $evento->id,
                    'nombre_archivo' => $archivo->getClientOriginalName(),
                    'ruta_archivo' => $ruta,
                    'tipo_mime' => $archivo->getMimeType(),
                    'uploaded_at' => now(),
                ]);
            }
        });

        return redirect()->route('hojasvida.show', [$tipo, $id])
            ->with('success', 'Evento registrado correctamente.');
    }

    public function index(Request $request)
    {
        $q = trim($request->q);
        $usuario = trim($request->usuario);

        /*
        |--------------------------------------------------------------------------
        | CONSULTAS PRINCIPALES (filtradas)
        |--------------------------------------------------------------------------
        */
        $cpu = CpuEquipo::query()
            ->when($q, function ($query) use ($q) {
                $query->where('n_activo', 'like', "%$q%")
                    ->orWhere('n_serial', 'like', "%$q%");
            })
            ->when($usuario, function ($query) use ($usuario) {
                $query->whereHas('empleado', function ($empleado) use ($usuario) {
                    $empleado->where('nombre', 'like', "%$usuario%");
                });
            })
            ->with('empleado')
            ->get()
            ->map(function ($item) {
                $item->tipo = 'cpu';
                $item->codigo_busqueda = $item->n_activo ?: $item->n_serial;

                return $item;
            });

        $telefonos = Telefono::query()
            ->when($q, function ($query) use ($q) {
                $query->where('serial', 'like', "%$q%");
            })
            ->when($usuario, function ($query) use ($usuario) {
                $query->whereHas('empleado', function ($empleado) use ($usuario) {
                    $empleado->where('nombre', 'like', "%$usuario%");
                });
            })
            ->with('empleado')
            ->get()
            ->map(function ($item) {
                $item->tipo = 'telefono';
                $item->codigo_busqueda = $item->serial;

                return $item;
            });

        $resultados = $cpu->merge($telefonos);

        /*
        |--------------------------------------------------------------------------
        | SELECT2 — CONSULTAS COMPLETAS (NO FILTRADAS)
        |--------------------------------------------------------------------------
        */
        $equipos = collect([
            ...CpuEquipo::all()->map(function ($item) {
                return (object) [
                    'tipo' => 'cpu',
                    'codigo_busqueda' => $item->n_activo ?: $item->n_serial,
                ];
            }),
            ...Telefono::all()->map(function ($item) {
                return (object) [
                    'tipo' => 'telefono',
                    'codigo_busqueda' => $item->serial,
                ];
            }),
        ]);

        $empleados = Empleado::select('id', 'nombre')
            ->orderBy('nombre')
            ->get();

        return view('hojasvida.index', compact('resultados', 'equipos', 'empleados'));
    }
}

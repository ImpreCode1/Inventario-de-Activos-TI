<?php

namespace App\Http\Controllers;

use App\Models\EquipoHojaVida;
use Illuminate\Http\Request;

class EquipoHojaVidaController extends Controller
{
    /**
     * Registrar un evento en la hoja de vida de cualquier equipo.
     */
    public function registrar(Request $request)
    {
        $request->validate([
            'equipo_id' => 'required|integer',
            'equipo_tipo' => 'required|string',
            'evento' => 'required|string',
            'descripcion' => 'nullable|string',
        ]);

        EquipoHojaVida::create([
            'equipo_id' => $request->equipo_id,
            'equipo_tipo' => $request->equipo_tipo,
            'evento' => $request->evento,
            'descripcion' => $request->descripcion,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Registro agregado a la hoja de vida.');
    }

    /**
     * Mostrar historial completo del equipo.
     */
    public function historial($tipo, $id)
    {
        // Obtener modelo dinámicamente
        $model = $this->resolverModelo($tipo);

        if (!$model) {
            abort(404, 'Tipo de equipo inválido.');
        }

        // Buscar el equipo
        $equipo = $model::findOrFail($id);

        // Traer su hoja de vida
        $historial = $equipo->hojaVida()->latest()->get();

        return view('equipos.hoja_vida', compact('equipo', 'historial', 'tipo'));
    }

    /**
     * Resolver modelo según tipo enviado.
     */
    private function resolverModelo($tipo)
    {
        return match ($tipo) {
            'cpu' => \App\Models\CpuEquipo::class,
            'celular' => \App\Models\Telefono::class,
            default => null
        };
    }
}

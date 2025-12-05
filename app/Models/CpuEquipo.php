<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpuEquipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_categoria',
        'id_marca',
        'serie',
        'n_activo',
        'costo',
        'n_serial',
        'n_parte',
        'memoria_ram',
        'procesador',
        'discoduro',
        'observaciones',
        'id_empleado',
        'nom_equipo',
    ];

    protected $casts = [
        'id_empleado' => 'integer',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria')->whereIn('nombre', ['CPU', 'PORTATIL', 'ALL-IN-ONE']);
    }

    public function hojaVida()
    {
        return $this->morphMany(EquipoHojaVida::class, 'equipo', 'equipo_tipo', 'equipo_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca');
    }

    public function historialEquipo()
    {
        return $this->hasMany(HistorialEquipo::class, 'id_portatiles', 'id');
    }

    public static function boot()
    {
        parent::boot();

        // Cuando se crea un equipo
        static::created(function ($equipo) {
            if ($equipo->id_empleado > 0) {
                self::actualizarHistorial($equipo->id, $equipo->id_empleado);
            }
        });

        // Cuando se actualiza y cambia el id_empleado
        static::updated(function ($equipo) {
            if ($equipo->isDirty('id_empleado')) {
                self::actualizarHistorial($equipo->id, $equipo->id_empleado);
            }
        });
    }

    public function setEstadoDisponible()
    {
        if (!empty($this->id_empleado)) {
            self::actualizarHistorial($this->id, 0);
        }
        $this->id_empleado = 0; // Lo mantenemos para no romper nada
        $this->save();
    }

    public static function actualizarHistorial($equipo_id, $empleado_id)
    {
        // Buscar el registro de historial del equipo actual
        $historialActual = self::historialAbierto($equipo_id);

        if ($empleado_id === 0) { // Cambiar estado a disponible
            if ($historialActual) {
                // Agregar fecha de devolución en el registro actual de historial del equipo
                $historialActual->fecha_devolucion = now()->format('Y-m-d');
                $historialActual->save();
            }

            // Crear historial para "Infraestructura"
            $nuevoHistorial = new HistorialEquipo();
            $nuevoHistorial->id_empleado = 0; // Infraestructura
            $nuevoHistorial->id_portatiles = $equipo_id;
            $nuevoHistorial->fecha_asignacion = now();
            $nuevoHistorial->save();

            return;
        }

        if ($historialActual) {
            // Si el empleado es el mismo, no hacemos nada
            if ($historialActual->id_empleado == $empleado_id) {
                return;
            }
            // Actualizar la fecha de devolución en el registro actual de historial del equipo
            $historialActual->fecha_devolucion = now()->format('Y-m-d');
            $historialActual->save();
        }

        // Crear un nuevo registro de historial del equipo para el nuevo empleado
        $nuevoHistorial = new HistorialEquipo();
        $nuevoHistorial->id_empleado = $empleado_id;
        $nuevoHistorial->id_portatiles = $equipo_id;
        $nuevoHistorial->fecha_asignacion = now()->format('Y-m-d');
        $nuevoHistorial->save();
    }

    private static function historialAbierto($equipo_id)
    {
        return HistorialEquipo::where('id_portatiles', $equipo_id)
            ->whereNull('fecha_devolucion')
            ->first();
    }
}

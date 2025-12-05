<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_categoria',
        'id_marca',
        'serial',
        'modelo',
        'n_telefono',
        'operador',
        'cedula',
        'email_1',
        'email_2',
        'serial_sim',
        'ram',
        'rom',
        'observaciones',
        'id_empleado',
    ];

    protected $casts = [
        'id_empleado' => 'integer',
    ];

    public function hojaVida()
    {
        return $this->morphMany(EquipoHojaVida::class, 'equipo', 'equipo_tipo', 'equipo_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria')->whereIn('nombre', ['CELULAR']);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca');
    }

    public function historialTelefono()
    {
        return $this->hasMany(HistorialTelefono::class, 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($telefono) {
            if ($telefono->id_empleado > 0) {
                self::actualizarTelefono($telefono->id, $telefono->id_empleado);
            }
        });

        // Cuando se actualiza y cambia el id_empleado
        static::updated(function ($telefono) {
            if ($telefono->isDirty('id_empleado')) {
                self::actualizarTelefono($telefono->id, $telefono->id_empleado);
            }
        });
    }

    public function setEstadoDisponible()
    {
        if (!empty($this->id_empleado)) { // Se asigna a un empleado específico
            $this->actualizarTelefono($this->id, 0); // Agregar fecha de devolución en el historial
        }
        $this->id_empleado = 0;
        $this->save();
    }

    public static function actualizarTelefono($celular_id, $empleado_id)
    {
        // Buscar el registro de historial del equipo actual
        $historialActual = self::historialAbierto($celular_id);

        if ($empleado_id === 0) { // Cambiar estado a disponible
            if ($historialActual) {
                // Agregar fecha de devolución en el registro actual de historial del equipo
                $historialActual->fecha_devolucion = now()->format('Y-m-d');
                $historialActual->save();
            }

            $nuevoHistorial = new HistorialTelefono();
            $nuevoHistorial->id_empleado = 0; // Infraestructura
            $nuevoHistorial->id_telefonos = $celular_id;
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
        $nuevoHistorial = new HistorialTelefono();
        $nuevoHistorial->id_empleado = $empleado_id;
        $nuevoHistorial->id_telefonos = $celular_id;
        $nuevoHistorial->fecha_asignacion = now()->format('Y-m-d');
        $nuevoHistorial->save();
    }

    private static function historialAbierto($telefono_id)
    {
        return HistorialTelefono::where('id_telefonos', $telefono_id)
            ->whereNull('fecha_devolucion')
            ->first();
    }
}

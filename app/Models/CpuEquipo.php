<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class CpuEquipo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_categoria',
        'id_marca',
        'serie',
        'n_activo',
        'n_serial',
        'n_parte',
        'memoria_ram',
        'procesador',
        'discoduro',
        'observaciones',
        'id_empleado',
        'nom_equipo'
    ];



    public function categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria')->whereIn('nombre', ['CPU', 'PORTATIL', 'ALL-IN-ONE']);
    }

    public function empleado(){
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }
    public function marca(){
        return $this->belongsTo(Marca::class, 'id_marca');
    }
    public function historialEquipo(){
        return $this->hasMany(HistorialEquipo::class, 'id');
    }
    
    public static function boot()
    {
        parent::boot();
    
        self::created(function ($cpuEquipo) {
            if ($cpuEquipo->id_empleado > 0) { // Se asigna a un empleado específico
                $historialEquipo = new HistorialEquipo();
                $historialEquipo->id_empleado = $cpuEquipo->id_empleado;
                $historialEquipo->id_portatiles = $cpuEquipo->id;
                $historialEquipo->fecha_asignacion = now();
                $historialEquipo->save();
            }
        });
    }

public function setEstadoDisponible()
{
    if ($this->id_empleado !== 0) { // Se asigna a un empleado específico
        $this->actualizarHistorial($this->id, 0); // Agregar fecha de devolución en el historial
    }
    $this->id_empleado = 0;
    $this->save();
}

public static function actualizarHistorial($equipo_id, $empleado_id)
{
    //Buscar el registro de historial del equipo actual
    $historialActual = HistorialEquipo::where('id_portatiles', $equipo_id)->whereNull('fecha_devolucion')->first();

    if ($empleado_id === 0) { // Cambiar estado a disponible
        if ($historialActual) {
            // Agregar fecha de devolución en el registro actual de historial del equipo
            $historialActual->fecha_devolucion = now()->format('Y-m-d');
            $historialActual->save();
        }
        return;
    }

    if ($historialActual) {
        // Si el empleado es el mismo, no hacemos nada
        if ($historialActual->id_empleado == $empleado_id) {
            return;
        }
        //Actualizar la fecha de devolución en el registro actual de historial del equipo
        $historialActual->fecha_devolucion = now()->format('Y-m-d');
        $historialActual->save();
    }

    //Crear un nuevo registro de historial del equipo para el nuevo empleado
    $nuevoHistorial = new HistorialEquipo();
    $nuevoHistorial->id_empleado = $empleado_id;
    $nuevoHistorial->id_portatiles = $equipo_id;
    $nuevoHistorial->fecha_asignacion = now()->format('Y-m-d');
    $nuevoHistorial->save();
}

}


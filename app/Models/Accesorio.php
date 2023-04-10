<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accesorio extends Model
{
    protected $fillable = [
        'id_categoria',
        'id_marca',
        'serie',
        'n_serial',
        'n_parte',
        'observaciones',
        'id_empleado',
    ];
    use HasFactory;

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria')->whereIn('nombre', ['DIADEMA', 'MOUSE',  'TECLADO', 'MONITOR', 'BASE REFRIGERANTE',  'TERMINAL', 'IMPRESORA', 'VIDEOPROYECTOR','SWITCH']);
    }

    public function empleado(){
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    public function marca(){
        return $this->belongsTo(Marca::class, 'id_marca');
    }

    public function historialAccesorio(){
        return $this->hasMany(HistorialAccesorio::class, 'id');
    }

    public static function boot()
    {
        parent::boot();
    
        self::created(function ($accesesorio) {
            if ($accesesorio->id_empleado > 0) { // Se asigna a un empleado específico
                $historialAccesesorio = new HistorialAccesorio();
                $historialAccesesorio->id_empleado = $accesesorio->id_empleado;
                $historialAccesesorio->id_accesorio = $accesesorio->id;
                $historialAccesesorio->fecha_asignacion = now();
                $historialAccesesorio->save();
            }
        });
    }

    public function setEstadoDisponible()
{
    if ($this->id_empleado !== 0) { // Se asigna a un empleado específico
        $this->actualizarAccesesorio($this->id, 0); // Agregar fecha de devolución en el historial
    }
    $this->id_empleado = 0;
    $this->save();
}


    public static function actualizarAccesesorio($accesorio_id, $empleado_id)
{
    //Buscar el registro de historial del equipo actual
    $historialActual = HistorialAccesorio::where('id_accesorio', $accesorio_id)->whereNull('fecha_devolucion')->first();

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
    $nuevoHistorial = new HistorialAccesorio();
    $nuevoHistorial->id_empleado = $empleado_id;
    $nuevoHistorial->id_accesorio = $accesorio_id;
    $nuevoHistorial->fecha_asignacion = now()->format('Y-m-d');
    $nuevoHistorial->save();
}
}

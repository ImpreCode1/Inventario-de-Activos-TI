<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria')->whereIn('nombre', ['CELULAR']);;
    }

    public function empleado(){
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    public function marca(){
        return $this->belongsTo(Marca::class, 'id_marca');
    }

    public function historialTelefono(){
        return $this->hasMany(HistorialTelefono::class, 'id');
    }

    public static function boot()
    {
        parent::boot();

        self::created(function ($telefono) {
            $historialtelefono = new HistorialTelefono();
            $historialtelefono->id_empleado = $telefono->id_empleado;
            $historialtelefono->id_telefonos = $telefono->id;
            $historialtelefono->fecha_asignacion = now();
            $historialtelefono->save();
        });
    }

    public static function actualizarTelefono($celular_id, $empleado_id){
        //Buscar el registro de historial del equipo actual
        $historialActual = HistorialTelefono::where('id_telefonos', $celular_id)->whereNull('fecha_devolucion')->first();
    
        if($historialActual){
            // Si el empleado es el mismo, no hacemos nada
            if($historialActual->id_empleado == $empleado_id){
                return;
            }
            //Actualizar la fecha de devolución en el registro actual de historial del equipo
            $historialActual->fecha_devolucion = now()->format('Y-m-d');
            $historialActual->save();
        }
    
        //Crear un nuevo registro de historial del equipo para el nuevo empleado
        $nuevoHistorial = new HistorialTelefono();
        $nuevoHistorial->id_empleado = $empleado_id;
        $nuevoHistorial->id_telefonos = $celular_id;
        $nuevoHistorial->fecha_asignacion = now()->format('Y-m-d');
        $nuevoHistorial->save();
    }
    
}

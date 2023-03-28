<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialEquipo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_empleado',
        'id_portatiles',
        'fecha_asignacion',
        'fecha_devolucion'
    ];

    public function empleado(){
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }
    public function cpuequipo(){
        return $this->belongsTo(CpuEquipo::class, 'id_portatiles');
    }
}

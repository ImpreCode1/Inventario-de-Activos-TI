<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialAccesorio extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_empleado',
        'id_accesorio',
        'fecha_asignacion',
        'fecha_devolucion'
    ];

    public function empleado(){
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    public function accesesorio(){
        return $this->belongsTo(Accesorio::class, 'id_accesorio');
    }


}

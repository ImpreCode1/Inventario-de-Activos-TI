<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpuEquipo extends Model
{
    use HasFactory;

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria')->whereIn('nombre', ['CPU', 'PORTATIL', 'ALL-IN-ONE']);
    }

    public function empleado(){
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }
    public function marca(){
        return $this->belongsTo(Marca::class, 'id_marca');
    }


}

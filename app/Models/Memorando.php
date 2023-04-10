<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memorando extends Model
{
    use HasFactory;

    protected $fillable = [
    'id_empleado', 'ciudad', 'direccion' , 'n_contacto', 'correo_encargado'
    ];

    public function empleado(){
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }
}

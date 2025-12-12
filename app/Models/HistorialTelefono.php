<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialTelefono extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_empleado',
        'id_telefonos',
        'fecha_asignacion',
        'fecha_devolucion',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    public function telefono()
    {
        return $this->belongsTo(Telefono::class, 'id_telefonos');
    }
}

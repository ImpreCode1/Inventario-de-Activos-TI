<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $fillable = [
        'usuario_id',
        'item_nombre',
        'fecha_prestamo',
        'fecha_devolucion',
        'estado',
        'observaciones',
        'creado_por',
    ];

    public function usuario()
    {
        return $this->belongsTo(Empleado::class, 'usuario_id');
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipoHojaVida extends Model
{
    protected $fillable = [
        'equipo_id',
        'equipo_tipo',
        'evento',
        'descripcion',
        'estado',
        'user_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function adjuntos()
    {
        return $this->hasMany(EquipoHojaVidaAdjunto::class, 'hoja_vida_id');
    }

    public function equipoCpu()
    {
        return $this->belongsTo(CpuEquipo::class, 'equipo_id')->where('equipo_tipo', 'cpu');
    }

    public function equipoTelefono()
    {
        return $this->belongsTo(Telefono::class, 'equipo_id')->where('equipo_tipo', 'telefono');
    }
}

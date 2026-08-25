<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipoHojaVidaAdjunto extends Model
{
    protected $table = 'equipo_hoja_vida_adjuntos';

    protected $fillable = [
        'hoja_vida_id',
        'nombre_archivo',
        'ruta_archivo',
        'tipo_mime',
        'uploaded_at',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
    ];

    public function hojaVida()
    {
        return $this->belongsTo(EquipoHojaVida::class, 'hoja_vida_id');
    }

    public function url()
    {
        return asset('storage/' . $this->ruta_archivo);
    }
}

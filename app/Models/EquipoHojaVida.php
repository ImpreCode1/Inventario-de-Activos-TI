<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoHojaVida extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipo_id',
        'equipo_tipo',
        'evento',
        'descripcion',
        'user_id',
    ];

    // Relación con usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación polimórfica manual (opcional)
    public function equipo()
    {
        return $this->morphTo(null, 'equipo_tipo', 'equipo_id');
    }
}

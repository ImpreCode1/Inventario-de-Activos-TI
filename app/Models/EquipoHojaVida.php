<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipoHojaVida extends Model
{
    protected $fillable = [
        'equipo_id',
        'equipo_tipo',
        'evento',
        'descripcion',
        'user_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


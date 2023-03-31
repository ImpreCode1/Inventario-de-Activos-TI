<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memorando extends Model
{
    use HasFactory;

    protected $fillable = [
    'id_empleado', 'ciudad', 'direccion' , 'n_contacto'
    ];

    public function empleado(){
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    public function portatilesMemorando(){
        return $this->hasMany(PortatilesMemorando::class, 'id');
    }
    public function telefonosMemorando(){
        return $this->hasMany(TelefonosMemorando::class, 'id');
    }
    public function accesesoriosMemorando(){
        return $this->hasMany(AccesesoriosMemorando::class, 'id');
    }
}

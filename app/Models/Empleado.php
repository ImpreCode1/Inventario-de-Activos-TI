<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    public function cargos(){
        return $this->belongsTo(Cargo::class, 'id_cargo');
    }

    public function departamentos(){
        return $this->belongsTo(Departamento::class, 'id_depto');
    }

    public function modoUsuarios(){
        return $this->belongsTo(ModoUsuario::class, 'id_modo_usuario');
    }
}

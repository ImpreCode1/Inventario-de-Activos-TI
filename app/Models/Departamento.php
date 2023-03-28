<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $fillable = [
        'id', 'nombre'
    ];
    use HasFactory;

    public function empleados(){
        return $this->hasMany(Empleado::class, 'id');
    }
}

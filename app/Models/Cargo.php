<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $fillable = [
        'id', 'nombre', 'detalle'
    ];
    use HasFactory;

    public function empleados(){
        return $this->hasMany(Empleado::class, 'id');
    }

}

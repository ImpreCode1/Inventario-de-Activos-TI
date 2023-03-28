<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_empleado'
    ];

    public function empleado(){
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }
}

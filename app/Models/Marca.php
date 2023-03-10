<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    public function cpuEquipo(){
        return $this->hasMany(CpuEquipo::class, 'id');
    }

    public function accesorio(){
        return $this->hasMany(Accesorio::class, 'id');
    }
}

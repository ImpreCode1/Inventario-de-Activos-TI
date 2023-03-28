<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'nombre'
    ];

    public function cpuEquipo(){
        return $this->hasMany(CpuEquipo::class, 'id');
    }

    public function accesorio(){
        return $this->hasMany(Accesorio::class, 'id');
    }
    public function celular(){
        return $this->hasMany(Telefono::class, 'id');
    }
}

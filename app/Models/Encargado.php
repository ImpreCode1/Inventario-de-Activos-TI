<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
    protected $fillable = [
        'id', 'encargado_bodega'
    ];
    use HasFactory;
}

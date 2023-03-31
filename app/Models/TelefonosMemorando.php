<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefonosMemorando extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_memorando', 'id_telefono'
       ];

       public function memorando(){
        return $this->belongsTo(Memorando::class, 'id_memorando');
    }

    public function telefono(){
        return $this->belongsTo(Telefono::class, 'id_telefono');
    }
}

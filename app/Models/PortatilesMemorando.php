<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortatilesMemorando extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_memorando', 'id_portatil'
       ];

       public function memorando(){
        return $this->belongsTo(Memorando::class, 'id_memorando');
    }

    public function cpuequipo(){
        return $this->belongsTo(CpuEquipo::class, 'id_portatil');
    }


}

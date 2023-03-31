<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccesesoriosMemorando extends Model
{
    use HasFactory;

    protected $fillable = [
       'id_memorando', 'id_accesorio'
      ];

      public function memorando(){
        return $this->belongsTo(Memorando::class, 'id_memorando');
    }

    public function accesesorio(){
        return $this->belongsTo(Accesorio::class, 'id_accesorio');
    }
}

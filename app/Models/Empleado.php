<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'nombre',
        'id_cargo',
        'id_depto',
        'num_exten',
        'retirado',
        'usu_dominio',
        'clave_dominio',
        'email',
        'id_modo_usuario'
    ];

    use HasFactory;


    public function cargos()
    {
        return $this->belongsTo(Cargo::class, 'id_cargo');
    }

    public function departamentos()
    {
        return $this->belongsTo(Departamento::class, 'id_depto');
    }

    public function modoUsuarios()
    {
        return $this->belongsTo(ModoUsuario::class, 'id_modo_usuario');
    }

    public function cpuEquipo()
    {
        return $this->hasMany(CpuEquipo::class, 'id');
    }

    public function accesorio()
    {
        return $this->hasMany(Accesorio::class, 'id');
    }
    public function celular()
    {
        return $this->hasMany(Telefono::class, 'id');
    }
    public function software()
    {
        return $this->hasMany(Software::class, 'id');
    }

    public function historialEquipo()
    {
        return $this->hasMany(HistorialEquipo::class, 'id');
    }

    public function historialAccesorio()
    {
        return $this->hasMany(HistorialAccesorio::class, 'id');
    }
    public function historialTelefono()
    {
        return $this->hasMany(HistorialTelefono::class, 'id');
    }
}

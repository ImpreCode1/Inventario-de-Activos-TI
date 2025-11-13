<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //tabla empleados
            'ver-empleado',
            'crear-empleado',
            'editar-empleado',
            'borrar-empleado',
            'pdf-empleado',
            'Activos-empleado',
            //tabla cargos
            'ver-cargo',
            'crear-cargo',
            'editar-cargo',
            'borrar-cargo',
            //tabla departamentos
            'ver-departamento',
            'crear-departamento',
            'editar-departamento',
            'borrar-departamento',
            //tabla marcas
            'ver-marca',
            'crear-marca',
            'editar-marca',
            'borrar-marca', 
            //tabla marcas
            'ver-categoria',
            'crear-categoria',
            'editar-categoria',
            'borrar-categoria',  
            //tabla cpu_equipos
            'ver-equipo',
            'crear-equipo',
            'editar-equipo',
            'borrar-equipo',
            'pdf-equipo',
            //tabla accesesorios
            'ver-accesesorio',
            'crear-accesesorio',
            'editar-accesesorio',
            'borrar-accesesorio',
            'pdf-accesesorio', 
            //tabla telefonos
            'ver-telefono',
            'crear-telefono',
            'editar-telefono',
            'borrar-telefono',
            'pdf-telefono',
            'SIM-PDF-telefono',
            //tabla HistorialEquipos
            'ver-HistorialEquipo',
            'borrar-HistorialEquipo',
            //tabla HistorialAccesesorios
            'ver-HistorialAccesesorio',
            'borrar-HistorialAccesesorio',
            //tabla HistorialTelefonos
            'ver-HistorialTelefono',
            'borrar-HistorialTelefono',
            //Tabla Memorandos
            'ver-memorando',
            'crear-memorando',
            'borrar-memorando',
            'pdf-memorando',
            //Tabla Software
            'ver-software',
            'crear-software',
            'borrar-software',
            'pdf-software',               
            //tabla usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',
            //tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }
    }
}

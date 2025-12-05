<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipoHojaVidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_hoja_vidas', function (Blueprint $table) {
            $table->id();

            // Referencia al equipo (PC, laptop, celular, impresora...)
            $table->unsignedBigInteger('equipo_id');

            // Tipo de equipo para saber a qué tabla pertenece
            $table->string('equipo_tipo');   // ej: 'cpu', 'laptop', 'celular', 'impresora'

            // Tipo de evento realizado
            $table->string('evento');        // 'aumento_ram', 'cambio_pieza', 'backup', 'formateo', etc.

            // Descripción detallada
            $table->text('descripcion')->nullable();

            // Usuario que ejecutó la acción
            $table->unsignedBigInteger('user_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipo_hoja_vidas');
    }
}

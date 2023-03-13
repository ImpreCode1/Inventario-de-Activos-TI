<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_equipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_empleado');
            $table->unsignedBigInteger('id_portatiles');

            $table->foreign('id_empleado')->references('id')->on('empleados');
            $table->foreign('id_portatiles')->references('id')->on('cpu_equipos');

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
        Schema::dropIfExists('historial_equipos');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialTelefonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_telefonos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_empleado');
            $table->unsignedBigInteger('id_telefonos');
            $table->date('fecha_asignacion')->nullable();
            $table->date('fecha_devolucion')->nullable();

            $table->foreign('id_empleado')->references('id')->on('empleados');
            $table->foreign('id_telefonos')->references('id')->on('telefonos');


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
        Schema::dropIfExists('historial_telefonos');
    }
}

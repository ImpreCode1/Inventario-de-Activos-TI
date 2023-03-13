<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialAccesoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_accesorios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_empleado');
            $table->unsignedBigInteger('id_accesorio');

            $table->foreign('id_empleado')->references('id')->on('empleados');
            $table->foreign('id_accesorio')->references('id')->on('accesorios');

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
        Schema::dropIfExists('historial_accesorios');
    }
}

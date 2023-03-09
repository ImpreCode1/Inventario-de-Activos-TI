<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCpuEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpu_equipos', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_marca');
            $table->string('serie', 80);
            $table->string('n_activo', 80);
            $table->string('n_serial', 80);
            $table->string('n_parte', 80);
            $table->string('memoria_ram', 80);
            $table->string('procesador', 80);
            $table->string('discoduro', 100);
            $table->string('observaciones', 100)->nullable(true);
            $table->unsignedBigInteger('id_empleado');
            $table->timestamps();
            $table->string('nom_equipo', 50);
            $table->softDeletes();

            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->foreign('id_marca')->references('id')->on('marcas');
            $table->foreign('id_empleado')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cpu_equipos');
    }
}

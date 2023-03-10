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
            $table->unsignedBigInteger('id_categoria')->nullable(true);
            $table->unsignedBigInteger('id_marca')->nullable(true);
            $table->string('serie', 80)->nullable(true);
            $table->string('n_activo', 80)->nullable(true);
            $table->string('n_serial', 80)->nullable(true);
            $table->string('n_parte', 80)->nullable(true);
            $table->string('memoria_ram', 80)->nullable(true);
            $table->string('procesador', 80)->nullable(true);
            $table->string('discoduro', 100)->nullable(true);
            $table->string('observaciones', 100)->nullable(true);
            $table->unsignedBigInteger('id_empleado')->nullable(true);
            $table->timestamps();
            $table->string('nom_equipo', 50)->nullable(true);
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

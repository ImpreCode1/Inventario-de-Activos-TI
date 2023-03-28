<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelefonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefonos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_marca');
            $table->string('serial', 70)->nullable(true);
            $table->string('modelo', 50)->nullable(true);
            $table->string('n_telefono', 50)->nullable(true);
            $table->string('email_1', 50)->nullable(true);
            $table->string('email_2', 50)->nullable(true);
            $table->string('serial_sim', 50)->nullable(true);
            $table->string('ram', 50)->nullable(true);
            $table->string('rom', 50)->nullable(true);
            $table->string('observaciones', 100)->nullable(true);
            $table->unsignedBigInteger('id_empleado');
            $table->softDeletes();

            $table->timestamps();

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
        Schema::dropIfExists('telefonos');
    }
}

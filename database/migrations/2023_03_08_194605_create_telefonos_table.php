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
            $table->unsignedBigInteger('id_marca');
            $table->string('modelo', 50);
            $table->string('n_telefono', 50);
            $table->string('email_1', 50);
            $table->string('email_2', 50);
            $table->string('serial_sim', 50);
            $table->string('ram', 50);
            $table->string('rom', 50);
            $table->unsignedBigInteger('id_empleado');
            $table->softDeletes();

            $table->timestamps();

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

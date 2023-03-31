<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemorandosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memorandos', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_empleado');
            $table->string('ciudad', 60)->nullable();
            $table->string('direccion', 150)->nullable();
            $table->string('n_contacto', 40)->nullable();
            $table->timestamps();
            
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
        Schema::dropIfExists('memorandos');
    }
}

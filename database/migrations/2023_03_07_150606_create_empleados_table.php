<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('id');
            $table->string('nombre', 100);
            $table->unsignedBigInteger('id_cargo');
            $table->unsignedBigInteger('id_depto');
            $table->string('clave_tel', 20);
            $table->string('num_exten', 40);
            $table->string('retirado', 30);
            $table->string('usu_dominio', 30);
            $table->string('clave_dominio', 20);
            $table->string('email', 80);
            $table->string('nom_usu', 30);
            $table->string('clave_usu', 60);
            $table->unsignedBigInteger('id_modo_usuario');
            $table->softDeletes();
            $table->timestamps();
            

            $table->foreign('id_cargo')->references('id')->on('cargos');
            $table->foreign('id_depto')->references('id')->on('departamentos');
            $table->foreign('id_modo_usuario')->references('id')->on('modo_usuarios');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}

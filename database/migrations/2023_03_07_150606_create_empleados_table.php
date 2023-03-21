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
            $table->string('nombre', 100)->nullable(true);
            $table->unsignedBigInteger('id_cargo')->nullable(true);
            $table->unsignedBigInteger('id_depto')->nullable(true);
            $table->string('clave_tel', 20)->nullable(true);
            $table->string('num_exten', 40)->nullable(true);
            $table->string('retirado', 30)->nullable(true);
            $table->string('usu_dominio', 30)->nullable(true);
            $table->string('clave_dominio', 20)->nullable(true);
            $table->string('email', 80)->nullable(true);
            $table->unsignedBigInteger('id_modo_usuario')->nullable(true);
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

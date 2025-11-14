<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->string('item_nombre');
            $table->dateTime('fecha_prestamo');
            $table->dateTime('fecha_devolucion')->nullable();
            $table->string('estado')->default('Prestado');
            $table->text('observaciones')->nullable();
            $table->unsignedBigInteger('creado_por');
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('creado_por')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
}

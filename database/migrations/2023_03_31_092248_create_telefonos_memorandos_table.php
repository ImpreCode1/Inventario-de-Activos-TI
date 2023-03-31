<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelefonosMemorandosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefonos_memorandos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_memorando');
            $table->unsignedBigInteger('id_telefono');
            $table->timestamps();
        
            $table->foreign('id_memorando')->references('id')->on('memorandos')->onDelete('cascade');
            $table->foreign('id_telefono')->references('id')->on('telefonos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefonos_memorandos');
    }
}

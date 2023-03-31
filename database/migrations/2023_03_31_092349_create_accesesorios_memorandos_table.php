<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesesoriosMemorandosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesesorios_memorandos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_memorando');
            $table->unsignedBigInteger('id_accesorio');
            $table->timestamps();

            $table->foreign('id_memorando')->references('id')->on('memorandos')->onDelete('cascade');
            $table->foreign('id_accesorio')->references('id')->on('accesorios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesesorios_memorandos');
    }
}

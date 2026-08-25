<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstadoAndAdjuntosToHojavida extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipo_hoja_vidas', function (Blueprint $table) {
            $table->string('estado', 20)->default('completado')->after('evento');
        });

        Schema::create('equipo_hoja_vida_adjuntos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hoja_vida_id')
                  ->constrained('equipo_hoja_vidas')
                  ->cascadeOnDelete();
            $table->string('nombre_archivo');
            $table->string('ruta_archivo');
            $table->string('tipo_mime');
            $table->timestamp('uploaded_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipo_hoja_vida_adjuntos');
        Schema::table('equipo_hoja_vidas', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
}

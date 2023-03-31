<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialAccesoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_accesorios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_empleado')->nullable(true);
            $table->unsignedBigInteger('id_accesorio')->nullable(true);
            $table->date('fecha_asignacion')->nullable(true);
            $table->date('fecha_devolucion')->nullable(true);

            $table->foreign('id_empleado')->references('id')->on('empleados')->onDelete('set null');
            $table->foreign('id_accesorio')->references('id')->on('accesorios')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_accesorios');
    }
}

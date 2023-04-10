<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesorios', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_categoria')->nullable(true);
            $table->unsignedBigInteger('id_marca')->nullable(true);
            $table->string('serie', 100)->nullable(true);
            $table->string('n_serial', 100)->nullable(true);
            $table->string('n_parte', 100)->nullable(true);
            $table->string('observaciones', 150)->nullable(true);
            $table->unsignedBigInteger('id_empleado')->nullable(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('set null');
            $table->foreign('id_marca')->references('id')->on('marcas')->onDelete('set null');
            $table->foreign('id_empleado')->references('id')->on('empleados')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesorios');
    }
}

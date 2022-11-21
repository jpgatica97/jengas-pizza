<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comandas', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha');
            $table->string('estado');
            $table->string('rut_encargado');
            $table->bigInteger('id_venta')->unsigned();

            $table->foreign('rut_encargado')->references('rut')->on('usuarios');
            $table->foreign('id_venta')->references('id')->on('ventas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comandas');
    }
};

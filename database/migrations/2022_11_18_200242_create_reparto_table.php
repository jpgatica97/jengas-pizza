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
        Schema::create('reparto', function (Blueprint $table) {
            $table->id();
            $table->string('estado');
            $table->string('rut_repartidor');
            $table->bigInteger('id_venta')->unsigned();

            $table->foreign('id_venta')->references('id')->on('ventas');
            $table->foreign('rut_repartidor')->references('rut')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reparto');
    }
};

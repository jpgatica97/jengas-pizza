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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha');
            $table->string('estado');
            $table->integer('neto');
            $table->integer('iva');
            $table->integer('total');
            $table->string('observaciones');
            $table->string('medio_venta');
            $table->string('metodo_pago');
            $table->string('rut_cliente');

            $table->foreign('rut_cliente')->references('rut')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};

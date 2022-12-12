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
        Schema::create('promociones_ventas', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo_promocion')->unsigned();
            $table->bigInteger('id_venta')->unsigned();
            $table->integer('cantidad')->unsigned();
            $table->integer('subtotal')->unsigned();

            $table->foreign('codigo_promocion')->references('codigo')->on('promociones');
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
        Schema::dropIfExists('promociones_ventas');
    }
};

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
        Schema::create('carrito_promocion', function (Blueprint $table) {
            $table->bigInteger('carrito_id')->unsigned();
            $table->integer('promocion_codigo')->unsigned();
            $table->integer('cantidad')->unsigned();

            $table->foreign('carrito_id')->references('id')->on('carritos');
            $table->foreign('promocion_codigo')->references('codigo')->on('promociones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrito_promocion');
    }
};

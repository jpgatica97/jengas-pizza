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
        Schema::create('productos_promociones', function (Blueprint $table) {
            $table->integer('codigo_producto')->unsigned();
            $table->integer('codigo_promocion')->unsigned();

            $table->foreign('codigo_producto')->references('codigo')->on('productos');
            $table->foreign('codigo_promocion')->references('codigo')->on('promociones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos_promociones');
    }
};

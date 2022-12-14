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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->string('rut')->unique();
            $table->string('nombre_completo');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('rol')->default('cliente');
            $table->string('habilitacion')->default('habilitado');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};

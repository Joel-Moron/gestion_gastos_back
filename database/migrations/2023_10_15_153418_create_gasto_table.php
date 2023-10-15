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
        Schema::create('gasto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->dateTime('fecha');
            $table->float('precio', 10, 2);
            $table->unsignedBigInteger('tipo_gasto_id');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('tipo_gasto_id')->references('id')->on('tipo_gasto');
            $table->foreign('usuario_id')->references('id')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gasto');
    }
};

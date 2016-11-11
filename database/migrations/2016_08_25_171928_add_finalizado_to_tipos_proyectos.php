<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFinalizadoToTiposProyectos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desarrollos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nombre');
            $table->text('descripcion');
            $table->integer('horas');
            $table->integer('cliente_id')->unsigned();
            $table->integer('tipo_proyecto_id')->unsigned();
            $table->date('entrega')->nullable();
            $table->boolean('finalizado')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('desarrollos');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComercialesAndEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('estados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('color')->nullable();
        });

        Schema::create('comerciales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->integer('tipo_proyecto_id')->unsigned()->nullable();
            $table->float('horas')->nullable();
            $table->string('presupuesto')->nullable();
            $table->integer('estado_id')->unsigned()->default(0);

            $table->foreign('estado_id')->references('id')->on('estados')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tipo_proyecto_id')->references('id')->on('tipos_proyectos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comerciales');
        Schema::drop('estados');
    }
}

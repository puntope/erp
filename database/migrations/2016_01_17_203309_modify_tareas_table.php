<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tareas', function (Blueprint $table) {
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->integer('tiempo')->default(60);
            $table->integer('cliente_id')->unsigned();
            $table->integer('tipo_proyecto_id')->unsigned();
            $table->integer('user_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tareas', function (Blueprint $table) {
            $table->dropColumn('titulo');
            $table->dropColumn('descripcion');
            $table->dropColumn('tiempo');
            $table->dropColumn('cliente_id');
            $table->dropColumn('tipo_proyecto_id');
            $table->dropColumn('user_id');
        });
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTareasForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tareas', function (Blueprint $table) {
            $table->foreign('cliente_id')
                ->references('id')->on('clientes');

            $table->foreign('tipo_proyecto_id')
                ->references('id')->on('tipos_proyectos');
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
            $table->dropForeign('tareas_cliente_id_foreign');
            $table->dropForeign('tareas_tipo_proyecto_id_foreign');
        });
    }
}

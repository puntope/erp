<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoClienteToClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->integer('tipo_cliente_id')->unsigned()->nullable();
            $table->foreign('tipo_cliente_id')
                ->references('id')->on('tipos_cliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropForeign(['tipo_cliente_id']);
            $table->dropColumn('tipo_cliente_id');
        });
    }
}

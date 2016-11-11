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
        Schema::table('desarrollos', function (Blueprint $table) {
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
        Schema::table('desarrollos', function (Blueprint $table) {
            $table->dropColumn('finalizado');
        });
    }
}

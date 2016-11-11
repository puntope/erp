<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnHorasMesToComerciales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comerciales', function (Blueprint $table) {
            $table->integer('horas_mes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comerciales', function (Blueprint $table) {
            $table->dropColumn('horas_mes');
        });
    }
}

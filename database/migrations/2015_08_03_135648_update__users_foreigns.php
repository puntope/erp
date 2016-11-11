<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersForeigns extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*niveles*/

        if (Schema::hasTable('user') && Schema::hasTable('niveles'))
        {
            Schema::table('user', function($table)
            {
                $table->foreign('nivel_id')->references('id')->on('niveles');
            });
        }

        /*puestos*/

        if (Schema::hasTable('user') && Schema::hasTable('puestos'))
        {
            Schema::table('user', function($table)
            {
                $table->foreign('puesto_id')->references('id')->on('puestos');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        if (Schema::hasTable('user') && Schema::hasTable('puestos'))
        {
            Schema::table('user', function($table)
            {
                $table->dropForeign('users_puesto_id_foreign');
            });
        }

        if (Schema::hasTable('user') && Schema::hasTable('niveles'))
        {
            Schema::table('user', function($table)
            {
                $table->dropForeign('users_nivel_id_foreign');
            });
        }

    }
}

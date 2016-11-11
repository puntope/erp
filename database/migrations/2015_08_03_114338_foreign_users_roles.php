<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignUsersRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users') && Schema::hasTable('roles'))
        {
            Schema::table('users', function($table)
            {
                $table->foreign('rol_id')->references('id')->on('roles');
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

        if (Schema::hasTable('users') && Schema::hasTable('roles'))
        {
            Schema::table('users', function($table)
            {
                $table->dropForeign('users_rol_id_foreign');
            });
        }

    }
}

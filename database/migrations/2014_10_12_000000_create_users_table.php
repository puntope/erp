<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('alias');
            $table->integer('rol_id')->unsigned();
            $table->string('direccion');
            $table->integer('cp');
            $table->string('ciudad');
            $table->string('provincia');
            $table->string('pais');
            $table->string('movil',15);
            $table->string('telefono',15);
            $table->string('avatar');
            $table->string('nif',10);
            $table->string('iban', 20);
            $table->timestamp('fecha_nacimiento');
            $table->integer('nivel_id')->unsigned();
            $table->integer('puesto_id')->unsigned();
            $table->text('otros');
            $table->rememberToken();
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
        Schema::drop('user');
    }
}

<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Tareas::class, function ($faker) {
    return [
        'titulo' => $faker->name,
        'descripcion' => $faker->paragraph,
        'tiempo' => $faker->numberBetween(15,300),
        'cliente_id' => 1,
        'tipo_proyecto_id' => 1,
        'user_id' => 1
    ];
});

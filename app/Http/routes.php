<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// Application routes

    Route::group(['middleware'=>['auth','authorized:2']], function() {
        Route::resource('user', 'UserController');
        Route::resource('tareas', 'TareasController');
        Route::resource('comerciales', 'AccionesComercialesController');
        Route::get('/comerciales/{id}/estado/{estado_id}','AccionesComercialesController@setEstado');
        Route::get('/comerciales/{id}/promotion','AccionesComercialesController@promotion');
    });

    Route::group(['middleware'=>['auth','authorized:3']], function() {
        Route::resource('clientes/todos', 'ClientesController@todos');
        Route::resource('clientes/tipos', 'TiposClientesController');

        Route::get('clientes/{id}/{mes}/{ano}/', 'ClientesController@historico');
        Route::get('desarrollos/finalizados','DesarrollosController@finalizados');
        Route::resource('clientes/tipos', 'TiposClientesController');
        Route::resource('desarrollos', 'DesarrollosController');
        Route::resource('clientes', 'ClientesController');
        Route::resource('user', 'UserController',['only' => ['show']]);
        Route::resource('proyectos', 'TiposProyectoController');
        Route::resource('analisis','AnalisisController');
    });

    //LOGED
    Route::group(['middleware' => ['auth','authorized:4']], function () {
        Route::get('/','TareasController@index');
        Route::resource('tareas', 'TareasController',['only' => ['store','show','index','create']]);
    });

    // Password reset link request routes...
    Route::get('password/email', 'Auth\PasswordController@getEmail');
    Route::post('password/email', 'Auth\PasswordController@postEmail');

    // Password reset routes...
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');

    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController'
    ]);

    //api
    Route::post('/api/tareas/analisis/export', 'AnalisisController@export');
    Route::get('/getExport/', 'AnalisisController@getExport');
    Route::post('/api/tareas/analisis/getAnalisis', 'AnalisisController@getAnalisis');
    Route::post('/api/tareas', 'TareasController@store');
    Route::post('/api/tareas/edit', 'TareasController@ApiUpdate');
    Route::get('/api/tareas', 'TareasController@getTareas');

    Route::get('/api/clientes/', 'ClientesController@getClientes');

    Route::get('/api/tiposProyecto/', 'TiposProyectoController@getTiposProyecto');
    Route::get('/api/desarrollos/finalizar/{id}', 'DesarrollosController@finalizar');
    Route::get('/api/desarrollos/{id_cliente}/{id_proyecto}/', 'DesarrollosController@getDesarrollos');

    Route::get('/api/usuarios/', 'UserController@getUsuarios');

    Route::get('/api/enviarTareas', 'TareasController@sendEmailTareas');




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

\Debugbar::disable();

Route::get('/', 'Layout\LayoutController@index');

Route::get('/login', function () {
    return view('login');
});

Route::group(['middleware' => ['role','cashier']], function () {
    Route::get('/VEROLE', function () {
        return 'se ve el role';
    });
});

 
Route::get('/test', function() {
    event(new \Salesfly\Events\SomeEvent());
    return 'event fired';
});

Route::get('/vista-redis', function() {
   return view('test');
});

Route::get('status', function(){
    return response('holi', 422)
        ->header('Content-Type', 'text/html; charset=UTF-8');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::group(['middleware' => 'role'], function () {
    Route::get('users/create', ['as' => 'user_create', 'uses' => 'Auth\AuthController@indexU']);
    Route::get('users/edit/{id?}', ['as' => 'user_edit', 'uses' => 'Auth\AuthController@indexU']);
    Route::get('users/form-create', ['as' => 'user_form_create', 'uses' => 'Auth\AuthController@form_create']);
    Route::get('users/form-edit', ['as' => 'user_form_edit', 'uses' => 'Auth\AuthController@form_edit']);
    Route::get('users', ['as' => 'user', 'uses' => 'Auth\AuthController@indexU']);
});
    Route::get('api/users/all', ['as' => 'user_all', 'uses' => 'Auth\AuthController@all']);
    Route::get('api/users/paginate/', ['as' => 'user_paginate', 'uses' => 'Auth\AuthController@paginate']);

    Route::post('api/users/create', ['as' => 'user_create', 'uses' => 'Auth\AuthController@postRegister']);
    Route::put('api/users/edit', ['as' => 'user_edit', 'uses' => 'Auth\AuthController@update']);
    Route::post('api/users/destroy', ['as' => 'user_destroy', 'uses' => 'Auth\AuthController@destroy']);
    Route::get('api/users/search/{q?}', ['as' => 'user_search', 'uses' => 'Auth\AuthController@search']);
    Route::get('api/users/find/{id}', ['as' => 'user_find', 'uses' => 'Auth\AuthController@find']);
    Route::get('api/users/stores', ['as' => 'user_stores_select', 'uses' => 'Auth\AuthController@store_select']);
    Route::get('api/users/disableuser/{id}', ['as' => 'user_disabled', 'uses' => 'Auth\AuthController@disableuser']);
    Route::post('api/users/changePass', 'Auth\AuthController@changePass');
//END

//PERSONS ROUTES
    Route::get('persons', ['as' => 'person', 'uses' => 'PersonsController@index']);
    Route::get('persons/create', ['as' => 'person_create', 'uses' => 'PersonsController@index']);
    Route::get('persons/edit/{id?}', ['as' => 'person_edit', 'uses' => 'PersonsController@index']);
    Route::get('persons/form-create', ['as' => 'person_form_create', 'uses' => 'PersonsController@form_create']);
    Route::get('persons/form-edit', ['as' => 'person_form_edit', 'uses' => 'PersonsController@form_edit']);
    Route::get('api/persons/all', ['as' => 'person_all', 'uses' => 'PersonsController@all']);
    Route::get('api/persons/paginate/', ['as' => 'person_paginate', 'uses' => 'PersonsController@paginatep']);
    Route::post('api/persons/create', ['as' => 'person_create', 'uses' => 'PersonsController@create']);
    Route::put('api/persons/edit', ['as' => 'person_edit', 'uses' => 'PersonsController@edit']);
    Route::post('api/persons/destroy', ['as' => 'person_destroy', 'uses' => 'PersonsController@destroy']);
    Route::get('api/persons/search/{q?}', ['as' => 'person_search', 'uses' => 'PersonsController@search']);
    Route::get('api/persons/find/{id}', ['as' => 'person_find', 'uses' => 'PersonsController@find']);
//END PERSONS ROUTES





//UBIGEOS ROUTES
    Route::get('ubigeos', ['as' => 'person', 'uses' => 'UbigeosController@index']);
    Route::get('ubigeos/create', ['as' => 'person_create', 'uses' => 'UbigeosController@index']);
    Route::get('ubigeos/edit/{id?}', ['as' => 'person_edit', 'uses' => 'UbigeosController@index']);
    Route::get('ubigeos/form-create', ['as' => 'person_form_create', 'uses' => 'UbigeosController@form_create']);
    Route::get('ubigeos/form-edit', ['as' => 'person_form_edit', 'uses' => 'UbigeosController@form_edit']);
    Route::get('api/ubigeos/all', ['as' => 'person_all', 'uses' => 'UbigeosController@all']);
    Route::get('api/ubigeos/paginate/', ['as' => 'person_paginate', 'uses' => 'UbigeosController@paginatep']);
    Route::post('api/ubigeos/create', ['as' => 'person_create', 'uses' => 'UbigeosController@create']);
    Route::put('api/ubigeos/edit', ['as' => 'person_edit', 'uses' => 'UbigeosController@edit']);
    Route::post('api/ubigeos/destroy', ['as' => 'person_destroy', 'uses' => 'UbigeosController@destroy']);
    Route::get('api/ubigeos/search/{q?}', ['as' => 'person_search', 'uses' => 'UbigeosController@search']);
    Route::get('api/ubigeos/find/{id}', ['as' => 'person_find', 'uses' => 'UbigeosController@find']);

    Route::get('api/ubigeos/validar/{text}','UbigeosController@validarCodigo');
    Route::get('api/ubigeoDepartamento/all', ['as' => 'person_all', 'uses' => 'UbigeosController@ubigeoDepartament']); 
    Route::get('api/ubigeoProvincia/recuperarUnDato/{d?}', ['as' => 'person_all', 'uses' => 'UbigeosController@ubigeoProvincia']); 
    Route::get('api/ubigeoDistrito/recuperarDosDato/{d?}/{p?}', ['as' => 'person_all', 'uses' => 'UbigeosController@ubigeoDistrito']); 
//END CATEGORIAS ROUTES

//ACREDITADORAS ROUTES
    Route::get('acreditadoras', ['as' => 'person', 'uses' => 'AcreditadorasController@index']);
    Route::get('acreditadoras/create', ['as' => 'person_create', 'uses' => 'AcreditadorasController@index']);
    Route::get('acreditadoras/edit/{id?}', ['as' => 'person_edit', 'uses' => 'AcreditadorasController@index']);
    Route::get('acreditadoras/form-create', ['as' => 'person_form_create', 'uses' => 'AcreditadorasController@form_create']);
    Route::get('acreditadoras/form-edit', ['as' => 'person_form_edit', 'uses' => 'AcreditadorasController@form_edit']);
    Route::get('api/acreditadoras/all', ['as' => 'person_all', 'uses' => 'AcreditadorasController@all']);
    Route::get('api/acreditadoras/paginate/', ['as' => 'person_paginate', 'uses' => 'AcreditadorasController@paginatep']);
    Route::post('api/acreditadoras/create', ['as' => 'person_create', 'uses' => 'AcreditadorasController@create']);
    Route::put('api/acreditadoras/edit', ['as' => 'person_edit', 'uses' => 'AcreditadorasController@edit']);
    Route::post('api/acreditadoras/destroy', ['as' => 'person_destroy', 'uses' => 'AcreditadorasController@destroy']);
    Route::get('api/acreditadoras/search/{q?}', ['as' => 'person_search', 'uses' => 'AcreditadorasController@search']);
    Route::get('api/acreditadoras/find/{id}', ['as' => 'person_find', 'uses' => 'AcreditadorasController@find']);
    Route::get('api/todasAcreditadoras/all', ['as' => 'person_all', 'uses' => 'AcreditadorasController@todas']);
//END CATEGORIAS ROUTES
    //MEDIOS PUBLICITARIO ROUTES
    Route::get('medioPublicitarios', ['as' => 'person', 'uses' => 'MedioPublicitariosController@index']);
    Route::get('medioPublicitarios/create', ['as' => 'person_create', 'uses' => 'MedioPublicitariosController@index']);
    Route::get('medioPublicitarios/edit/{id?}', ['as' => 'person_edit', 'uses' => 'MedioPublicitariosController@index']);
    Route::get('medioPublicitarios/form-create', ['as' => 'person_form_create', 'uses' => 'MedioPublicitariosController@form_create']);
    Route::get('medioPublicitarios/form-edit', ['as' => 'person_form_edit', 'uses' => 'MedioPublicitariosController@form_edit']);
    Route::get('api/medioPublicitarios/all', ['as' => 'person_all', 'uses' => 'MedioPublicitariosController@all']);
    Route::get('api/medioPublicitarios/paginate/', ['as' => 'person_paginate', 'uses' => 'MedioPublicitariosController@paginatep']);
    Route::post('api/medioPublicitarios/create', ['as' => 'person_create', 'uses' => 'MedioPublicitariosController@create']);
    Route::put('api/medioPublicitarios/edit', ['as' => 'person_edit', 'uses' => 'MedioPublicitariosController@edit']);
    Route::post('api/medioPublicitarios/destroy', ['as' => 'person_destroy', 'uses' => 'MedioPublicitariosController@destroy']);
    Route::get('api/medioPublicitarios/search/{q?}', ['as' => 'person_search', 'uses' => 'MedioPublicitariosController@search']);
    Route::get('api/medioPublicitarios/find/{id}', ['as' => 'person_find', 'uses' => 'MedioPublicitariosController@find']);
//END CATEGORIAS ROUTES
    //BANCOS ROUTES
    Route::get('bancos', ['as' => 'person', 'uses' => 'BancosController@index']);
    Route::get('bancos/create', ['as' => 'person_create', 'uses' => 'BancosController@index']);
    Route::get('bancos/edit/{id?}', ['as' => 'person_edit', 'uses' => 'BancosController@index']);
    Route::get('bancos/form-create', ['as' => 'person_form_create', 'uses' => 'BancosController@form_create']);
    Route::get('bancos/form-edit', ['as' => 'person_form_edit', 'uses' => 'BancosController@form_edit']);
    Route::get('api/bancos/all', ['as' => 'person_all', 'uses' => 'BancosController@all']);
    Route::get('api/bancos/paginate/', ['as' => 'person_paginate', 'uses' => 'BancosController@paginatep']);
    Route::post('api/bancos/create', ['as' => 'person_create', 'uses' => 'BancosController@create']);
    Route::put('api/bancos/edit', ['as' => 'person_edit', 'uses' => 'BancosController@edit']);
    Route::post('api/bancos/destroy', ['as' => 'person_destroy', 'uses' => 'BancosController@destroy']);
    Route::get('api/bancos/search/{q?}', ['as' => 'person_search', 'uses' => 'BancosController@search']);
    Route::get('api/bancos/find/{id}', ['as' => 'person_find', 'uses' => 'BancosController@find']);

    Route::get('api/cargarBancos/all', ['as' => 'person_all', 'uses' => 'BancosController@CargarBancos']);
//END CATEGORIAS ROUTES
    //PROFESIONES ROUTES
    Route::get('profesiones', ['as' => 'person', 'uses' => 'ProfesionesController@index']);
    Route::get('profesiones/create', ['as' => 'person_create', 'uses' => 'ProfesionesController@index']);
    Route::get('profesiones/edit/{id?}', ['as' => 'person_edit', 'uses' => 'ProfesionesController@index']);
    Route::get('profesiones/form-create', ['as' => 'person_form_create', 'uses' => 'ProfesionesController@form_create']);
    Route::get('profesiones/form-edit', ['as' => 'person_form_edit', 'uses' => 'ProfesionesController@form_edit']);
    Route::get('api/profesiones/all', ['as' => 'person_all', 'uses' => 'ProfesionesController@all']);
    Route::get('api/profesiones/paginate/', ['as' => 'person_paginate', 'uses' => 'ProfesionesController@paginatep']);
    Route::post('api/profesiones/create', ['as' => 'person_create', 'uses' => 'ProfesionesController@create']);
    Route::put('api/profesiones/edit', ['as' => 'person_edit', 'uses' => 'ProfesionesController@edit']);
    Route::post('api/profesiones/destroy', ['as' => 'person_destroy', 'uses' => 'ProfesionesController@destroy']);
    Route::get('api/profesiones/search/{q?}', ['as' => 'person_search', 'uses' => 'ProfesionesController@search']);
    Route::get('api/profesiones/find/{id}', ['as' => 'person_find', 'uses' => 'ProfesionesController@find']);

    Route::get('api/cargarProfesiones/all', ['as' => 'person_all', 'uses' => 'ProfesionesController@CargarProfeciones']);
//END CATEGORIAS ROUTES
    //PERSONAS ROUTES
    Route::get('personas', ['as' => 'person', 'uses' => 'PersonasController@index']);
    Route::get('personas/create', ['as' => 'person_create', 'uses' => 'PersonasController@index']);
    Route::get('personas/edit/{id?}', ['as' => 'person_edit', 'uses' => 'PersonasController@index']);
    Route::get('personas/form-create', ['as' => 'person_form_create', 'uses' => 'PersonasController@form_create']);
    Route::get('personas/form-edit', ['as' => 'person_form_edit', 'uses' => 'PersonasController@form_edit']);
    Route::get('api/personas/all', ['as' => 'person_all', 'uses' => 'PersonasController@all']);
    Route::get('api/personas/paginate/', ['as' => 'person_paginate', 'uses' => 'PersonasController@paginatep']);
    Route::post('api/personas/create', ['as' => 'person_create', 'uses' => 'PersonasController@create']);
    Route::put('api/personas/edit', ['as' => 'person_edit', 'uses' => 'PersonasController@edit']);
    Route::post('api/personas/destroy', ['as' => 'person_destroy', 'uses' => 'PersonasController@destroy']);
    Route::get('api/personas/search/{q?}', ['as' => 'person_search', 'uses' => 'PersonasController@search']);
    Route::get('api/personas/find/{id}', ['as' => 'person_find', 'uses' => 'PersonasController@find']);
    
    Route::get('api/personas/validar/{text}','PersonasController@validarDni');
    Route::get('api/personas/disablePersona/{id}',['as'=>'product_disabled', 'uses'=>'PersonasController@disablePersona']);
//END CATEGORIAS ROUTES
    //CUENTAS BANCARIAS ROUTES
    Route::get('cuentaBancarias', ['as' => 'person', 'uses' => 'CuentaBancariasController@index']);
    Route::get('cuentaBancarias/create', ['as' => 'person_create', 'uses' => 'CuentaBancariasController@index']);
    Route::get('cuentaBancarias/edit/{id?}', ['as' => 'person_edit', 'uses' => 'CuentaBancariasController@index']);
    Route::get('cuentaBancarias/form-create', ['as' => 'person_form_create', 'uses' => 'CuentaBancariasController@form_create']);
    Route::get('cuentaBancarias/form-edit', ['as' => 'person_form_edit', 'uses' => 'CuentaBancariasController@form_edit']);
    Route::get('api/cuentaBancarias/all', ['as' => 'person_all', 'uses' => 'CuentaBancariasController@all']);
    Route::get('api/cuentaBancarias/paginate/', ['as' => 'person_paginate', 'uses' => 'CuentaBancariasController@paginatep']);
    Route::post('api/cuentaBancarias/create', ['as' => 'person_create', 'uses' => 'CuentaBancariasController@create']);
    Route::put('api/cuentaBancarias/edit', ['as' => 'person_edit', 'uses' => 'CuentaBancariasController@edit']);
    Route::post('api/cuentaBancarias/destroy', ['as' => 'person_destroy', 'uses' => 'CuentaBancariasController@destroy']);
    Route::get('api/cuentaBancarias/search/{q?}', ['as' => 'person_search', 'uses' => 'CuentaBancariasController@search']);
    Route::get('api/cuentaBancarias/find/{id}', ['as' => 'person_find', 'uses' => 'CuentaBancariasController@find']);
//END CATEGORIAS ROUTES
    //PERSONAS ROUTES
    Route::get('docentes', ['as' => 'person', 'uses' => 'DocentesController@index']);
    Route::get('docentes/create', ['as' => 'person_create', 'uses' => 'DocentesController@index']);
    Route::get('docentes/edit/{id?}', ['as' => 'person_edit', 'uses' => 'DocentesController@index']);
    Route::get('docentes/form-create', ['as' => 'person_form_create', 'uses' => 'DocentesController@form_create']);
    Route::get('docentes/form-edit', ['as' => 'person_form_edit', 'uses' => 'DocentesController@form_edit']);
    Route::get('api/docentes/all', ['as' => 'person_all', 'uses' => 'DocentesController@all']);
    Route::get('api/docentes/paginate/', ['as' => 'person_paginate', 'uses' => 'DocentesController@paginatep']);
    Route::post('api/docentes/create', ['as' => 'person_create', 'uses' => 'DocentesController@create']);
    Route::put('api/docentes/edit', ['as' => 'person_edit', 'uses' => 'DocentesController@edit']);
    Route::post('api/docentes/destroy', ['as' => 'person_destroy', 'uses' => 'DocentesController@destroy']);
    Route::get('api/docentes/search/{q?}', ['as' => 'person_search', 'uses' => 'DocentesController@search']);
    Route::get('api/docentes/find/{id}', ['as' => 'person_find', 'uses' => 'DocentesController@find']);
    
    Route::get('api/docentes/validar/{text}','DocentesController@validarDni');
    Route::get('api/docentes/disablePersona/{id}',['as'=>'product_disabled', 'uses'=>'DocentesController@disablePersona']);

    Route::post('api/docentes/uploadFile',['as'=>'product_disabled', 'uses'=>'DocentesController@uploadFile']);

    Route::get('api/buscarDocente/recuperarUnDato/{d?}', ['as' => 'person_all', 'uses' => 'DocentesController@buscarDocente']);
//END CATEGORIAS ROUTES
//PERSONS ROUTES
    Route::get('cursos', ['as' => 'person', 'uses' => 'CursosController@index']);
    Route::get('cursos/create', ['as' => 'person_create', 'uses' => 'CursosController@index']);
    Route::get('cursos/edit/{id?}', ['as' => 'person_edit', 'uses' => 'CursosController@index']);
    Route::get('cursos/form-create', ['as' => 'person_form_create', 'uses' => 'CursosController@form_create']);
    Route::get('cursos/form-edit', ['as' => 'person_form_edit', 'uses' => 'CursosController@form_edit']);
    Route::get('api/cursos/all', ['as' => 'person_all', 'uses' => 'CursosController@all']);
    Route::get('api/cursos/paginate/', ['as' => 'person_paginate', 'uses' => 'CursosController@paginatep']);
    Route::post('api/cursos/create', ['as' => 'person_create', 'uses' => 'CursosController@create']);
    Route::put('api/cursos/edit', ['as' => 'person_edit', 'uses' => 'CursosController@edit']);
    Route::post('api/cursos/destroy', ['as' => 'person_destroy', 'uses' => 'CursosController@destroy']);
    Route::get('api/cursos/search/{q?}', ['as' => 'person_search', 'uses' => 'CursosController@search']);
    Route::get('api/cursos/find/{id}', ['as' => 'person_find', 'uses' => 'CursosController@find']);
    Route::get('api/todasCursos/all', ['as' => 'person_all', 'uses' => 'CursosController@todas']);
//END PERSONS ROUTES
//PERSONS ROUTES
    Route::get('ediciones', ['as' => 'person', 'uses' => 'EdicionesController@index']);
    Route::get('ediciones/create', ['as' => 'person_create', 'uses' => 'EdicionesController@index']);
    Route::get('ediciones/edit/{id?}', ['as' => 'person_edit', 'uses' => 'EdicionesController@index']);
    Route::get('ediciones/form-create', ['as' => 'person_form_create', 'uses' => 'EdicionesController@form_create']);
    Route::get('ediciones/form-edit', ['as' => 'person_form_edit', 'uses' => 'EdicionesController@form_edit']);
    Route::get('api/ediciones/all', ['as' => 'person_all', 'uses' => 'EdicionesController@all']);
    Route::get('api/ediciones/paginate/', ['as' => 'person_paginate', 'uses' => 'EdicionesController@paginatep']);
    Route::post('api/ediciones/create', ['as' => 'person_create', 'uses' => 'EdicionesController@create']);
    Route::put('api/ediciones/edit', ['as' => 'person_edit', 'uses' => 'EdicionesController@edit']);
    Route::post('api/ediciones/destroy', ['as' => 'person_destroy', 'uses' => 'EdicionesController@destroy']);
    Route::get('api/ediciones/search/{q?}', ['as' => 'person_search', 'uses' => 'EdicionesController@search']);
    Route::get('api/ediciones/find/{id}', ['as' => 'person_find', 'uses' => 'EdicionesController@find']);

    Route::post('api/ediciones/uploadFile',['as'=>'product_disabled', 'uses'=>'DocentesController@uploadFile']);
//END PERSONS ROUTES
//PERSONS ROUTES
    Route::post('api/detalleDocenteEdiciones/create', ['as' => 'person_create', 'uses' => 'DetalleDocenteEdicionesController@create']);
    Route::put('api/detalleDocenteEdiciones/edit', ['as' => 'person_edit', 'uses' => 'DetalleDocenteEdicionesController@edit']);
    Route::post('api/detalleDocenteEdiciones/destroy', ['as' => 'person_destroy', 'uses' => 'DetalleDocenteEdicionesController@destroy']);
    Route::get('api/detalleDocenteEdiciones/search/{q?}', ['as' => 'person_search', 'uses' => 'DetalleDocenteEdicionesController@search']);
//END PERSONS ROUTES
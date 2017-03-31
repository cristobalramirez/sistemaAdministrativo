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
    Route::get('api/cargarMedioPublicitarios/all', ['as' => 'person_all', 'uses' => 'MedioPublicitariosController@CargarMedioPublicitarios']);
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
    Route::get('api/buscarPersona/recuperarUnDato/{d?}', ['as' => 'person_all', 'uses' => 'PersonasController@buscarPersona']);
    Route::get('api/buscarPersonaConDni/recuperarUnDato/{d?}', ['as' => 'person_all', 'uses' => 'PersonasController@buscarPersonaConDni']);
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

    Route::get('api/todasCuentas/all', ['as' => 'person_all', 'uses' => 'CuentaBancariasController@todas']);
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

    Route::get('api/ediciones/disablePersona/{id}',['as'=>'product_disabled', 'uses'=>'EdicionesController@disablePersona']);

    Route::post('api/ediciones/uploadFile',['as'=>'product_disabled', 'uses'=>'DocentesController@uploadFile']);
    Route::get('api/buscarEdicion/recuperarUnDato/{d?}', ['as' => 'person_all', 'uses' => 'EdicionesController@buscarEdicion']);


    
    //Route::put('api/inscribir', ['as' => 'person_edit', 'uses' => 'EdicionesController@edit']);
//END PERSONS ROUTES
//PERSONS ROUTES
    Route::post('api/detalleDocenteEdiciones/create', ['as' => 'person_create', 'uses' => 'DetalleDocenteEdicionesController@create']);
    Route::put('api/detalleDocenteEdiciones/edit', ['as' => 'person_edit', 'uses' => 'DetalleDocenteEdicionesController@edit']);
    Route::post('api/detalleDocenteEdiciones/destroy', ['as' => 'person_destroy', 'uses' => 'DetalleDocenteEdicionesController@destroy']);
    Route::get('api/detalleDocenteEdiciones/search/{q?}', ['as' => 'person_search', 'uses' => 'DetalleDocenteEdicionesController@search']);
//END PERSONS ROUTES
//CUENTAS BANCARIAS ROUTES
    Route::get('inscripciones', ['as' => 'person', 'uses' => 'InscripcionesController@index']);
    Route::get('inscripciones/create', ['as' => 'person_create', 'uses' => 'InscripcionesController@index']);
    Route::get('inscripciones/edit/{id?}', ['as' => 'person_edit', 'uses' => 'InscripcionesController@index']);
    Route::get('inscripciones/form-create', ['as' => 'person_form_create', 'uses' => 'InscripcionesController@form_create']);
    Route::get('inscripciones/form-edit', ['as' => 'person_form_edit', 'uses' => 'InscripcionesController@form_edit']);
    Route::get('api/inscripciones/all', ['as' => 'person_all', 'uses' => 'InscripcionesController@all']);
    Route::get('api/inscripciones/paginate/', ['as' => 'person_paginate', 'uses' => 'InscripcionesController@paginatep']);
    Route::post('api/inscripciones/create', ['as' => 'person_create', 'uses' => 'InscripcionesController@create']);
    Route::put('api/inscripciones/edit', ['as' => 'person_edit', 'uses' => 'InscripcionesController@edit']);
    Route::post('api/inscripciones/destroy', ['as' => 'person_destroy', 'uses' => 'InscripcionesController@destroy']);
    Route::get('api/inscripciones/search/{q?}', ['as' => 'person_search', 'uses' => 'InscripcionesController@search']);
    Route::get('api/inscripciones/find/{id}', ['as' => 'person_find', 'uses' => 'InscripcionesController@find']);

    Route::get('api/buscarInscripcion/recuperarDosDato/{d?}/{p?}', ['as' => 'person_all', 'uses' => 'InscripcionesController@buscarInscripcion']);
    Route::get('api/buscaredicionCurso/recuperarDosDatoPag/{c?}/{e?}/{f?}/', ['as' => 'person_search', 'uses' => 'InscripcionesController@searchCurso']); 
    
    Route::get('api/edicionesCurso/recuperarUnDato/{c?}/{e?}', ['as' => 'person_all', 'uses' => 'EdicionesController@edicionesCurso']); 

    Route::post('api/vaucherPago/uploadFile',['as'=>'product_disabled', 'uses'=>'InscripcionesController@uploadFile']);

    Route::put('api/realizarPago/edit', ['as' => 'person_edit', 'uses' => 'InscripcionesController@realizarPago']);
    
    Route::post('api/eliminarPago/destroy', ['as' => 'person_destroy', 'uses' => 'InscripcionesController@eliminarPago']);

//END CATEGORIAS ROUTES

    Route::get('inscribir/{id?}','InscribirController@index');
    Route::get('inscribir/form-inscribir','InscribirController@form_inscribir');
    Route::post('api/inscribir/create','InscripcionesController@createInscribir');

    //------------------------------
    //ACREDITADORAS ROUTES
    Route::get('categorias', ['as' => 'person', 'uses' => 'CategoriasController@index']);
    Route::get('categorias/create', ['as' => 'person_create', 'uses' => 'CategoriasController@index']);
    Route::get('categorias/edit/{id?}', ['as' => 'person_edit', 'uses' => 'CategoriasController@index']);
    Route::get('categorias/form-create', ['as' => 'person_form_create', 'uses' => 'CategoriasController@form_create']);
    Route::get('categorias/form-edit', ['as' => 'person_form_edit', 'uses' => 'CategoriasController@form_edit']);
    Route::get('api/categorias/all', ['as' => 'person_all', 'uses' => 'CategoriasController@all']);
    Route::get('api/categorias/paginate/', ['as' => 'person_paginate', 'uses' => 'CategoriasController@paginatep']);
    Route::post('api/categorias/create', ['as' => 'person_create', 'uses' => 'CategoriasController@create']);
    Route::put('api/categorias/edit', ['as' => 'person_edit', 'uses' => 'CategoriasController@edit']);
    Route::post('api/categorias/destroy', ['as' => 'person_destroy', 'uses' => 'CategoriasController@destroy']);
    Route::get('api/categorias/search/{q?}', ['as' => 'person_search', 'uses' => 'CategoriasController@search']);
    Route::get('api/categorias/find/{id}', ['as' => 'person_find', 'uses' => 'CategoriasController@find']);
    Route::get('api/cargarCategorias/all', ['as' => 'person_all', 'uses' => 'CategoriasController@cargarCategorias']);
//END CATEGORIAS ROUTES
    //ACREDITADORAS ROUTES
    Route::get('paises', ['as' => 'person', 'uses' => 'PaisesController@index']);
    Route::get('paises/create', ['as' => 'person_create', 'uses' => 'PaisesController@index']);
    Route::get('paises/edit/{id?}', ['as' => 'person_edit', 'uses' => 'PaisesController@index']);
    Route::get('paises/form-create', ['as' => 'person_form_create', 'uses' => 'PaisesController@form_create']);
    Route::get('paises/form-edit', ['as' => 'person_form_edit', 'uses' => 'PaisesController@form_edit']);
    Route::get('api/paises/all', ['as' => 'person_all', 'uses' => 'PaisesController@all']);
    Route::get('api/paises/paginate/', ['as' => 'person_paginate', 'uses' => 'PaisesController@paginatep']);
    Route::post('api/paises/create', ['as' => 'person_create', 'uses' => 'PaisesController@create']);
    Route::put('api/paises/edit', ['as' => 'person_edit', 'uses' => 'PaisesController@edit']);
    Route::post('api/paises/destroy', ['as' => 'person_destroy', 'uses' => 'PaisesController@destroy']);
    Route::get('api/paises/search/{q?}', ['as' => 'person_search', 'uses' => 'PaisesController@search']);
    Route::get('api/paises/find/{id}', ['as' => 'person_find', 'uses' => 'PaisesController@find']);
    Route::get('api/cargarPaises/all', ['as' => 'person_all', 'uses' => 'PaisesController@cargarPaises']);
//END CATEGORIAS ROUTES
//ACREDITADORAS ROUTES
    Route::get('promociones', ['as' => 'person', 'uses' => 'PromocionesController@index']);
    Route::get('promociones/create', ['as' => 'person_create', 'uses' => 'PromocionesController@index']);
    Route::get('promociones/edit/{id?}', ['as' => 'person_edit', 'uses' => 'PromocionesController@index']);
    Route::get('promociones/form-create', ['as' => 'person_form_create', 'uses' => 'PromocionesController@form_create']);
    Route::get('promociones/form-edit', ['as' => 'person_form_edit', 'uses' => 'PromocionesController@form_edit']);
    Route::get('api/promociones/all', ['as' => 'person_all', 'uses' => 'PromocionesController@all']);
    Route::get('api/promociones/paginate/', ['as' => 'person_paginate', 'uses' => 'PromocionesController@paginatep']);
    Route::post('api/promociones/create', ['as' => 'person_create', 'uses' => 'PromocionesController@create']);
    Route::put('api/promociones/edit', ['as' => 'person_edit', 'uses' => 'PromocionesController@edit']);
    Route::post('api/promociones/destroy', ['as' => 'person_destroy', 'uses' => 'PromocionesController@destroy']);
    Route::get('api/promociones/search/{q?}', ['as' => 'person_search', 'uses' => 'PromocionesController@search']);
    Route::get('api/promociones/find/{id}', ['as' => 'person_find', 'uses' => 'PromocionesController@find']);
    Route::get('api/cargarPromociones/all', ['as' => 'person_all', 'uses' => 'PromocionesController@cargarPromociones']);
//END CATEGORIAS ROUTES
//ACREDITADORAS ROUTES
    Route::get('empleados', ['as' => 'person', 'uses' => 'EmpleadosController@index']);
    Route::get('empleados/create', ['as' => 'person_create', 'uses' => 'EmpleadosController@index']);
    Route::get('empleados/edit/{id?}', ['as' => 'person_edit', 'uses' => 'EmpleadosController@index']);
    Route::get('empleados/form-create', ['as' => 'person_form_create', 'uses' => 'EmpleadosController@form_create']);
    Route::get('empleados/form-edit', ['as' => 'person_form_edit', 'uses' => 'EmpleadosController@form_edit']);
    Route::get('api/empleados/all', ['as' => 'person_all', 'uses' => 'EmpleadosController@all']);
    Route::get('api/empleados/paginate/', ['as' => 'person_paginate', 'uses' => 'EmpleadosController@paginatep']);
    Route::post('api/empleados/create', ['as' => 'person_create', 'uses' => 'EmpleadosController@create']);
    Route::put('api/empleados/edit', ['as' => 'person_edit', 'uses' => 'EmpleadosController@edit']);
    Route::post('api/empleados/destroy', ['as' => 'person_destroy', 'uses' => 'EmpleadosController@destroy']);
    Route::get('api/empleados/search/{q?}', ['as' => 'person_search', 'uses' => 'EmpleadosController@search']);
    Route::get('api/empleados/find/{id}', ['as' => 'person_find', 'uses' => 'EmpleadosController@find']);
    
    Route::get('api/empleados/validar/{text}','EmpleadosController@validarDni');
    Route::get('api/empleados/disablePersona/{id}',['as'=>'product_disabled', 'uses'=>'EmpleadosController@disablePersona']);

    Route::get('api/buscarEmpleado/recuperarUnDato/{d?}', ['as' => 'person_all', 'uses' => 'EmpleadosController@buscarEmpleado']);
    Route::get('api/cargarEmpleados/all', ['as' => 'person_all', 'uses' => 'EmpleadosController@cargarEmpleados']);
//END CATEGORIAS ROUTES
Route::get('api/pagos/recuperarUnDato/{q?}', ['as' => 'person_search', 'uses' => 'PagosController@search']);

//ACREDITADORAS ROUTES
    Route::get('seguimientoInscripciones', ['as' => 'person', 'uses' => 'SeguimientoInscripcionController@index']);
    Route::get('seguimientoInscripciones/create', ['as' => 'person_create', 'uses' => 'SeguimientoInscripcionController@index']);
    Route::get('seguimientoInscripciones/edit/{id?}', ['as' => 'person_edit', 'uses' => 'SeguimientoInscripcionController@index']);
    Route::get('seguimientoInscripciones/form-create', ['as' => 'person_form_create', 'uses' => 'SeguimientoInscripcionController@form_create']);
    Route::get('seguimientoInscripciones/form-edit', ['as' => 'person_form_edit', 'uses' => 'SeguimientoInscripcionController@form_edit']);
    Route::get('api/seguimientoInscripciones/all', ['as' => 'person_all', 'uses' => 'SeguimientoInscripcionController@all']);
    Route::get('api/seguimientoInscripciones/paginate/', ['as' => 'person_paginate', 'uses' => 'SeguimientoInscripcionController@paginatep']);
    Route::post('api/seguimientoInscripciones/create', ['as' => 'person_create', 'uses' => 'SeguimientoInscripcionController@create']);
    Route::put('api/seguimientoInscripciones/edit', ['as' => 'person_edit', 'uses' => 'SeguimientoInscripcionController@edit']);
    Route::post('api/seguimientoInscripciones/destroy', ['as' => 'person_destroy', 'uses' => 'SeguimientoInscripcionController@destroy']);
    Route::get('api/seguimientoInscripciones/search/{q?}', ['as' => 'person_search', 'uses' => 'SeguimientoInscripcionController@search']);
    Route::get('api/seguimientoInscripciones/find/{id}', ['as' => 'person_find', 'uses' => 'SeguimientoInscripcionController@find']);
    Route::get('api/seguimientos/recuperarUnDato/{q?}', ['as' => 'person_search', 'uses' => 'SeguimientoInscripcionController@seguimientos']);
//END CATEGORIAS ROUTES
//ACREDITADORAS ROUTES
    Route::get('agencias', ['as' => 'person', 'uses' => 'AgenciasController@index']);
    Route::get('agencias/create', ['as' => 'person_create', 'uses' => 'AgenciasController@index']);
    Route::get('agencias/edit/{id?}', ['as' => 'person_edit', 'uses' => 'AgenciasController@index']);
    Route::get('agencias/form-create', ['as' => 'person_form_create', 'uses' => 'AgenciasController@form_create']);
    Route::get('agencias/form-edit', ['as' => 'person_form_edit', 'uses' => 'AgenciasController@form_edit']);
    Route::get('api/agencias/all', ['as' => 'person_all', 'uses' => 'AgenciasController@all']);
    Route::get('api/agencias/paginate/', ['as' => 'person_paginate', 'uses' => 'AgenciasController@paginatep']);
    Route::post('api/agencias/create', ['as' => 'person_create', 'uses' => 'AgenciasController@create']);
    Route::put('api/agencias/edit', ['as' => 'person_edit', 'uses' => 'AgenciasController@edit']);
    Route::post('api/agencias/destroy', ['as' => 'person_destroy', 'uses' => 'AgenciasController@destroy']);
    Route::get('api/agencias/search/{q?}', ['as' => 'person_search', 'uses' => 'AgenciasController@search']);
    Route::get('api/agencias/find/{id}', ['as' => 'person_find', 'uses' => 'AgenciasController@find']);
    Route::get('api/cargarAgencias/all', ['as' => 'person_all', 'uses' => 'AgenciasController@cargarAgencias']);
//END CATEGORIAS ROUTES
//ACREDITADORAS ROUTES
    Route::get('envios', ['as' => 'person', 'uses' => 'EnviosController@index']);
    Route::get('envios/create', ['as' => 'person_create', 'uses' => 'EnviosController@index']);
    Route::get('envios/edit/{id?}', ['as' => 'person_edit', 'uses' => 'EnviosController@index']);
    Route::get('envios/form-create', ['as' => 'person_form_create', 'uses' => 'EnviosController@form_create']);
    Route::get('envios/form-edit', ['as' => 'person_form_edit', 'uses' => 'EnviosController@form_edit']);
    Route::get('api/envios/all', ['as' => 'person_all', 'uses' => 'EnviosController@all']);
    Route::get('api/envios/paginate/', ['as' => 'person_paginate', 'uses' => 'EnviosController@paginatep']);
    Route::post('api/envios/create', ['as' => 'person_create', 'uses' => 'EnviosController@create']);
    Route::put('api/envios/edit', ['as' => 'person_edit', 'uses' => 'EnviosController@edit']);
    Route::post('api/envios/destroy', ['as' => 'person_destroy', 'uses' => 'EnviosController@destroy']);
    Route::get('api/envios/search/{q?}', ['as' => 'person_search', 'uses' => 'EnviosController@search']);
    Route::get('api/envios/find/{id}', ['as' => 'person_find', 'uses' => 'EnviosController@find']);
    Route::get('api/envioInscripcion/find/{id}', ['as' => 'person_find', 'uses' => 'EnviosController@envioInscripcion']);
//END CATEGORIAS ROUTES
//TIPO GASTOS ROUTES
    Route::get('tipogastos', ['as' => 'person', 'uses' => 'TipoGastosController@index']);
    Route::get('tipogastos/create', ['as' => 'person_create', 'uses' => 'TipoGastosController@index']);
    Route::get('tipogastos/edit/{id?}', ['as' => 'person_edit', 'uses' => 'TipoGastosController@index']);
    Route::get('tipogastos/form-create', ['as' => 'person_form_create', 'uses' => 'TipoGastosController@form_create']);
    Route::get('tipogastos/form-edit', ['as' => 'person_form_edit', 'uses' => 'TipoGastosController@form_edit']);
    Route::get('api/tipogastos/all', ['as' => 'person_all', 'uses' => 'TipoGastosController@all']);
    Route::get('api/tipogastos/paginate/', ['as' => 'person_paginate', 'uses' => 'TipoGastosController@paginatep']);
    Route::post('api/tipogastos/create', ['as' => 'person_create', 'uses' => 'TipoGastosController@create']);
    Route::put('api/tipogastos/edit', ['as' => 'person_edit', 'uses' => 'TipoGastosController@edit']);
    Route::post('api/tipogastos/destroy', ['as' => 'person_destroy', 'uses' => 'TipoGastosController@destroy']);
    Route::get('api/tipogastos/search/{q?}', ['as' => 'person_search', 'uses' => 'TipoGastosController@search']);
    Route::get('api/tipogastos/find/{id}', ['as' => 'person_find', 'uses' => 'TipoGastosController@find']);
//END TIPO GASTOS ROUTES
//TIPO Comprobantes ROUTES
    Route::get('tipocomprobantes', ['as' => 'person', 'uses' => 'TipoComprobanteController@index']);
    Route::get('tipocomprobantes/create', ['as' => 'person_create', 'uses' => 'TipoComprobanteController@index']);
    Route::get('tipocomprobantes/edit/{id?}', ['as' => 'person_edit', 'uses' => 'TipoComprobanteController@index']);
    Route::get('tipocomprobantes/form-create', ['as' => 'person_form_create', 'uses' => 'TipoComprobanteController@form_create']);
    Route::get('tipocomprobantes/form-edit', ['as' => 'person_form_edit', 'uses' => 'TipoComprobanteController@form_edit']);
    Route::get('api/tipocomprobantes/all', ['as' => 'person_all', 'uses' => 'TipoComprobanteController@all']);
    Route::get('api/tipocomprobantes/paginate/', ['as' => 'person_paginate', 'uses' => 'TipoComprobanteController@paginatep']);
    Route::post('api/tipocomprobantes/create', ['as' => 'person_create', 'uses' => 'TipoComprobanteController@create']);
    Route::put('api/tipocomprobantes/edit', ['as' => 'person_edit', 'uses' => 'TipoComprobanteController@edit']);
    Route::post('api/tipocomprobantes/destroy', ['as' => 'person_destroy', 'uses' => 'TipoComprobanteController@destroy']);
    Route::get('api/tipocomprobantes/search/{q?}', ['as' => 'person_search', 'uses' => 'TipoComprobanteController@search']);
    Route::get('api/tipocomprobantes/find/{id}', ['as' => 'person_find', 'uses' => 'TipoComprobanteController@find']);
//END TIPO Comprobantes ROUTES

//TIPO ESCALA ROUTES
    Route::get('escalas', ['as' => 'person', 'uses' => 'EscalaController@index']);
    Route::get('escalas/create', ['as' => 'person_create', 'uses' => 'EscalaController@index']);
    Route::get('escalas/edit/{id?}', ['as' => 'person_edit', 'uses' => 'EscalaController@index']);
    Route::get('escalas/form-create', ['as' => 'person_form_create', 'uses' => 'EscalaController@form_create']);
    Route::get('escalas/form-edit', ['as' => 'person_form_edit', 'uses' => 'EscalaController@form_edit']);
    Route::get('api/escalas/all', ['as' => 'person_all', 'uses' => 'EscalaController@all']);
    Route::get('api/escalas/paginate/', ['as' => 'person_paginate', 'uses' => 'EscalaController@paginatep']);
    Route::post('api/escalas/create', ['as' => 'person_create', 'uses' => 'EscalaController@create']);
    Route::put('api/escalas/edit', ['as' => 'person_edit', 'uses' => 'EscalaController@edit']);
    Route::post('api/escalas/destroy', ['as' => 'person_destroy', 'uses' => 'EscalaController@destroy']);
    Route::get('api/escalas/search/{q?}', ['as' => 'person_search', 'uses' => 'EscalaController@search']);
    Route::get('api/escalas/find/{id}', ['as' => 'person_find', 'uses' => 'EscalaController@find']);

    Route::get('api/cargarescala/all', ['as' => 'person_all', 'uses' => 'EscalaController@CargarEscala']);
//END TIPO ESCALA ROUTES

//TIPO ESPECIALIDAD ROUTES
    Route::get('especialidades', ['as' => 'person', 'uses' => 'EspecialidadController@index']);
    Route::get('especialidades/create', ['as' => 'person_create', 'uses' => 'EspecialidadController@index']);
    Route::get('especialidades/edit/{id?}', ['as' => 'person_edit', 'uses' => 'EspecialidadController@index']);
    Route::get('especialidades/form-create', ['as' => 'person_form_create', 'uses' => 'EspecialidadController@form_create']);
    Route::get('especialidades/form-edit', ['as' => 'person_form_edit', 'uses' => 'EspecialidadController@form_edit']);
    Route::get('api/especialidades/all', ['as' => 'person_all', 'uses' => 'EspecialidadController@all']);
    Route::get('api/especialidades/paginate/', ['as' => 'person_paginate', 'uses' => 'EspecialidadController@paginatep']);
    Route::post('api/especialidades/create', ['as' => 'person_create', 'uses' => 'EspecialidadController@create']);
    Route::put('api/especialidades/edit', ['as' => 'person_edit', 'uses' => 'EspecialidadController@edit']);
    Route::post('api/especialidades/destroy', ['as' => 'person_destroy', 'uses' => 'EspecialidadController@destroy']);
    Route::get('api/especialidades/search/{q?}', ['as' => 'person_search', 'uses' => 'EspecialidadController@search']);
    Route::get('api/especialidades/find/{id}', ['as' => 'person_find', 'uses' => 'EspecialidadController@find']);

    Route::get('api/cargarespecialidad/all', ['as' => 'person_all', 'uses' => 'EspecialidadController@CargarEspecialidad']);
//END TIPO ESPECIALIDAD ROUTES
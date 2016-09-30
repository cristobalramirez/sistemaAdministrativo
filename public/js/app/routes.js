(function(){
    angular.module('routes',[])
        .config(['$routeProvider','$locationProvider', function ($routeProvider,$locationProvider) {
            $routeProvider
            // ------------------------------------------------------
            
           // ------------------------------------------------------
                           
                .when('/persons', {
                    templateUrl: '/js/app/persons/views/index.html',
                    controller: 'PersonController'
                })
                .when('/persons/create',{
                    templateUrl:'/persons/form-create',
                    controller: 'PersonController'
                })
                .when('/persons/edit/:id',{
                    templateUrl:'/persons/form-edit',
                    controller: 'PersonController'
                })
                .when('/users', {
                    templateUrl: '/js/app/users/views/index.html',
                    controller: 'UserController'
                })
                .when('/users/create',{
                    templateUrl:'/users/form-create',
                    controller: 'UserController'
                })
                .when('/users/edit/:id',{
                    templateUrl:'/users/form-edit',
                    controller: 'UserController'
                })
                
                //------------------
                //RUTES UBIGEOS
                .when('/ubigeos', {
                    templateUrl: '/js/app/ubigeos/views/index.html',
                    controller: 'UbigeoController'
                })
                .when('/ubigeos/create',{
                    templateUrl:'/ubigeos/form-create',
                    controller: 'UbigeoController'
                })
                .when('/ubigeos/edit/:id',{
                    templateUrl:'/ubigeos/form-edit',
                    controller: 'UbigeoController'
                }) 
                //------------------
                //RUTES ACREDITADORAS
                .when('/acreditadoras', {
                    templateUrl: '/js/app/acreditadoras/views/index.html',
                    controller: 'AcreditadoraController'
                })
                .when('/acreditadoras/create',{
                    templateUrl:'/acreditadoras/form-create',
                    controller: 'AcreditadoraController'
                })
                .when('/acreditadoras/edit/:id',{
                    templateUrl:'/acreditadoras/form-edit',
                    controller: 'AcreditadoraController'
                }) 
                //------------------
                //RUTES MEDIOS PUBLICITARIOS
                .when('/medioPublicitarios', {
                    templateUrl: '/js/app/medioPublicitarios/views/index.html',
                    controller: 'MedioPublicitarioController'
                })
                .when('/medioPublicitarios/create',{
                    templateUrl:'/medioPublicitarios/form-create',
                    controller: 'MedioPublicitarioController'
                })
                .when('/medioPublicitarios/edit/:id',{
                    templateUrl:'/medioPublicitarios/form-edit',
                    controller: 'MedioPublicitarioController'
                }) 
                //------------------
                //RUTES BANCOS
                .when('/bancos', {
                    templateUrl: '/js/app/bancos/views/index.html',
                    controller: 'BancoController'
                })
                .when('/bancos/create',{
                    templateUrl:'/bancos/form-create',
                    controller: 'BancoController'
                })
                .when('/bancos/edit/:id',{
                    templateUrl:'/bancos/form-edit',
                    controller: 'BancoController'
                }) 
                //------------------
                //RUTES PROFESIONES
                .when('/profesiones', {
                    templateUrl: '/js/app/profesiones/views/index.html',
                    controller: 'ProfesionController'
                })
                .when('/profesiones/create',{
                    templateUrl:'/profesiones/form-create',
                    controller: 'ProfesionController'
                })
                .when('/profesiones/edit/:id',{
                    templateUrl:'/profesiones/form-edit',
                    controller: 'ProfesionController'
                }) 
                //------------------
                //RUTES PERSONAS
                .when('/personas', {
                    templateUrl: '/js/app/personas/views/index.html',
                    controller: 'PersonaController'
                })
                .when('/personas/create',{
                    templateUrl:'/personas/form-create',
                    controller: 'PersonaController'
                })
                .when('/personas/edit/:id',{
                    templateUrl:'/personas/form-edit',
                    controller: 'PersonaController'
                }) 
                //------------------
                //RUTES CUENTAS BANCARIAS
                .when('/cuentaBancarias', {
                    templateUrl: '/js/app/cuentaBancarias/views/index.html',
                    controller: 'CuentaBancariaController'
                })
                .when('/cuentaBancarias/create',{
                    templateUrl:'/cuentaBancarias/form-create',
                    controller: 'CuentaBancariaController'
                })
                .when('/cuentaBancarias/edit/:id',{
                    templateUrl:'/cuentaBancarias/form-edit',
                    controller: 'CuentaBancariaController'
                }) 
                //------------------
                //------------------
                //RUTES PERSONAS
                .when('/docentes', {
                    templateUrl: '/js/app/docentes/views/index.html',
                    controller: 'DocenteController'
                })
                .when('/docentes/create',{
                    templateUrl:'/docentes/form-create',
                    controller: 'DocenteController'
                })
                .when('/docentes/edit/:id',{
                    templateUrl:'/docentes/form-edit',
                    controller: 'DocenteController'
                }) 
                //------------------
                //RUTES PERSONAS
                .when('/cursos', {
                    templateUrl: '/js/app/cursos/views/index.html',
                    controller: 'CursoController'
                })
                .when('/cursos/create',{
                    templateUrl:'/cursos/form-create',
                    controller: 'CursoController'
                })
                .when('/cursos/edit/:id',{
                    templateUrl:'/cursos/form-edit',
                    controller: 'CursoController'
                }) 
                //------------------
                //RUTES PERSONAS
                .when('/ediciones', {
                    templateUrl: '/js/app/ediciones/views/index.html',
                    controller: 'EdicionController'
                })
                .when('/ediciones/create',{
                    templateUrl:'/ediciones/form-create',
                    controller: 'EdicionController'
                })
                .when('/ediciones/edit/:id',{
                    templateUrl:'/ediciones/form-edit',
                    controller: 'EdicionController'
                }) 
                .when('/inscribir/:id',{
                    templateUrl:'/ediciones/form-inscribir',
                    controller: 'EdicionController'
                }) 
                //------------------
                //RUTES PERSONAS
                .when('/ediciones', {
                    templateUrl: '/js/app/ediciones/views/index.html',
                    controller: 'EdicionController'
                })
                .when('/ediciones/create',{
                    templateUrl:'/ediciones/form-create',
                    controller: 'EdicionController'
                })
                .when('/ediciones/edit/:id',{
                    templateUrl:'/ediciones/form-edit',
                    controller: 'EdicionController'
                }) 
                //------------------//RUTES PERSONAS
                .when('/inscripciones', {
                    templateUrl: '/js/app/inscripciones/views/index.html',
                    controller: 'InscripcionController'
                })
                .when('/inscripciones/create',{
                    templateUrl:'/inscripciones/form-create',
                    controller: 'InscripcionController'
                })
                .when('/inscripciones/edit/:id',{
                    templateUrl:'/inscripciones/form-edit',
                    controller: 'InscripcionController'
                }) 
                //------------------
                .otherwise({
                    redirectTo: '/'
                });
                
            $locationProvider.html5Mode(true);
        }]);

})();

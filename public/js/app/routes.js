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
                //RUTES PRODUCTOS
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
                .otherwise({
                    redirectTo: '/'
                });
                
            $locationProvider.html5Mode(true);
        }]);

})();

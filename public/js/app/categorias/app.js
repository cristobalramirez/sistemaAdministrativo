(function(){
    var app = angular.module('categorias',[
        'ngRoute',
        'ngSanitize',
        'categorias.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
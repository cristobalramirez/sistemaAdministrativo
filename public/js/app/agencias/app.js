(function(){
    var app = angular.module('agencias',[
        'ngRoute',
        'ngSanitize',
        'agencias.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
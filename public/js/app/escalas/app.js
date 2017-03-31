(function(){
    var app = angular.module('escalas',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'escalas.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
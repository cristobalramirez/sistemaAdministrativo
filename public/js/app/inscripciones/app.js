(function(){
    var app = angular.module('inscripciones',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'inscripciones.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
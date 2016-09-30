(function(){
    var app = angular.module('inscribir',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'inscribir.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
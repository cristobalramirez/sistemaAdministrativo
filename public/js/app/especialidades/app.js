(function(){
    var app = angular.module('especialidades',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'especialidades.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
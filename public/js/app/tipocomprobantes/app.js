(function(){
    var app = angular.module('tipocomprobantes',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'tipocomprobantes.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
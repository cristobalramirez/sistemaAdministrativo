 (function(){
    var app = angular.module('empleados',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'empleados.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
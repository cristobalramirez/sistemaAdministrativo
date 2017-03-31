(function(){
    var app = angular.module('tipogastos',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'tipogastos.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
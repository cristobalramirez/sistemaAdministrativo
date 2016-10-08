(function(){
    var app = angular.module('promociones',[
        'ngRoute',
        'ngSanitize',
        'promociones.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
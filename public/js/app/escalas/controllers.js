(function(){
    angular.module('escalas.controllers',[])
        .controller('EscalaController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.escalas = [];
                $scope.escala = {};
                $scope.categorias = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('escalas',$scope.query,$scope.currentPage).then(function (data){
                        $scope.escalas = data.data;
                    });
                    }else{
                        crudService.paginate('escalas',$scope.currentPage).then(function (data) {
                            $scope.escalas = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'escalas').then(function (data) {
                        $scope.escala = data;
                    });

                    crudService.all('cargarCategorias').then(function (data) {
                        $scope.categorias = data;
                    });
                }else{
                    crudService.paginate('escalas',1).then(function (data) {
                        $scope.escalas = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                    crudService.all('cargarCategorias').then(function (data) {
                        $scope.categorias = data;
                    });
                }

                

                $scope.searchEscala= function(){
                if ($scope.query.length > 0) {
                    crudService.search('escalas',$scope.query,1).then(function (data){
                        $scope.escalas = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('escalas',1).then(function (data) {
                        $scope.escalas = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createEscala = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.escalaCreateForm.$valid) {
                            crudService.create($scope.escala, 'escalas').then(function (data) {
                          
                                if (data['estado'] == true) {
                                    $scope.success = data['nombres'];
                                    alert('Grabado correctamente');
                                    $location.path('/escalas');

                                } else {
                                    $scope.errors = data;

                                }
                            });
                    }
                }


                $scope.editEscala= function(row){
                    $location.path('/escalas/edit/'+row.id);
                };

                $scope.updateEscala = function(){

                    if ($scope.escalaEditForm.$valid) {
                            crudService.update($scope.escala,'escalas').then(function(data)
                            {
                                if(data['estado'] == true){
                                    $scope.success = data['nombres'];
                                    alert('Editado correctamente');
                                    $location.path('/escalas');
                                }else{
                                    $scope.errors =data;
                                }
                            });
                        
                    }
                };

                $scope.deleteEscala= function(row){
                    
                    $scope.escala = row;
                }

                $scope.cancelEscala = function(){
                    $scope.escala = {};
                }

                $scope.destroyEscala = function(){
                    crudService.destroy($scope.escala,'escalas').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.escala = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();

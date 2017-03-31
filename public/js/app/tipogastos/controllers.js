(function(){
    angular.module('tipogastos.controllers',[])
        .controller('TipoGastoController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.tipogastos = [];
                $scope.tipogasto = {};
                $scope.categorias = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('tipogastos',$scope.query,$scope.currentPage).then(function (data){
                        $scope.tipogastos = data.data;
                    });
                    }else{
                        crudService.paginate('tipogastos',$scope.currentPage).then(function (data) {
                            $scope.tipogastos = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'tipogastos').then(function (data) {
                        $scope.tipogasto = data;
                    });

                    crudService.all('cargarCategorias').then(function (data) {
                        $scope.categorias = data;
                    });
                }else{
                    crudService.paginate('tipogastos',1).then(function (data) {
                        $scope.tipogastos = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                    crudService.all('cargarCategorias').then(function (data) {
                        $scope.categorias = data;
                    });
                }

                

                $scope.searchTipoGasto= function(){
                if ($scope.query.length > 0) {
                    crudService.search('tipogastos',$scope.query,1).then(function (data){
                        $scope.tipogastos = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('tipogastos',1).then(function (data) {
                        $scope.tipogastos = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createTipoGasto = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.tipoGastoCreateForm.$valid) {
                            crudService.create($scope.tipogasto, 'tipogastos').then(function (data) {
                          
                                if (data['estado'] == true) {
                                    $scope.success = data['nombres'];
                                    alert('Grabado correctamente');
                                    $location.path('/tipogastos');

                                } else {
                                    $scope.errors = data;

                                }
                            });
                    }
                }


                $scope.editTipoGasto = function(row){
                    $location.path('/tipogastos/edit/'+row.id);
                };

                $scope.updateTipoGasto = function(){

                    if ($scope.tipoGastoEditForm.$valid) {
                            crudService.update($scope.tipogasto,'tipogastos').then(function(data)
                            {
                                if(data['estado'] == true){
                                    $scope.success = data['nombres'];
                                    alert('Editado correctamente');
                                    $location.path('/tipogastos');
                                }else{
                                    $scope.errors =data;
                                }
                            });
                        
                    }
                };

                $scope.deleteTipoGasto= function(row){
                    
                    $scope.tipogasto = row;
                }

                $scope.cancelTipoGasto = function(){
                    $scope.tipogasto = {};
                }

                $scope.destroyTipoGasto = function(){
                    crudService.destroy($scope.tipogasto,'tipogastos').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.tipogasto = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();

(function(){
    angular.module('tipocomprobantes.controllers',[])
        .controller('TipoComprobanteController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.tipocomprobantes = [];
                $scope.tipocomprobante = {};
                $scope.categorias = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('tipocomprobantes',$scope.query,$scope.currentPage).then(function (data){
                        $scope.tipocomprobantes = data.data;
                    });
                    }else{
                        crudService.paginate('tipocomprobantes',$scope.currentPage).then(function (data) {
                            $scope.tipocomprobantes = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'tipocomprobantes').then(function (data) {
                        $scope.tipocomprobante = data;
                    });

                    crudService.all('cargarCategorias').then(function (data) {
                        $scope.categorias = data;
                    });
                }else{
                    crudService.paginate('tipocomprobantes',1).then(function (data) {
                        $scope.tipocomprobantes = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                    crudService.all('cargarCategorias').then(function (data) {
                        $scope.categorias = data;
                    });
                }

                

                $scope.searchTipoComprobante= function(){
                if ($scope.query.length > 0) {
                    crudService.search('tipocomprobantes',$scope.query,1).then(function (data){
                        $scope.tipocomprobantes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('tipocomprobantes',1).then(function (data) {
                        $scope.tipocomprobantes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createTipoComprobante = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.tipoComprobanteCreateForm.$valid) {
                            crudService.create($scope.tipocomprobante, 'tipocomprobantes').then(function (data) {
                          
                                if (data['estado'] == true) {
                                    $scope.success = data['nombres'];
                                    alert('Grabado correctamente');
                                    $location.path('/tipocomprobantes');

                                } else {
                                    $scope.errors = data;

                                }
                            });
                    }
                }


                $scope.editTipoComprobante= function(row){
                    $location.path('/tipocomprobantes/edit/'+row.id);
                };

                $scope.updateTipoComprobante = function(){

                    if ($scope.tipoComprobanteEditForm.$valid) {
                            crudService.update($scope.tipocomprobante,'tipocomprobantes').then(function(data)
                            {
                                if(data['estado'] == true){
                                    $scope.success = data['nombres'];
                                    alert('Editado correctamente');
                                    $location.path('/tipocomprobantes');
                                }else{
                                    $scope.errors =data;
                                }
                            });
                        
                    }
                };

                $scope.deleteTipoComprobante= function(row){
                    
                    $scope.tipocomprobante = row;
                }

                $scope.cancelTipoComprobante = function(){
                    $scope.tipocomprobante = {};
                }

                $scope.destroyTipoComprobante = function(){
                    crudService.destroy($scope.tipocomprobante,'tipocomprobantes').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.tipocomprobante = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();

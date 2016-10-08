(function(){
    angular.module('promociones.controllers',[])
        .controller('PromocionController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.promociones = [];
                $scope.promocion = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('promociones',$scope.query,$scope.currentPage).then(function (data){
                        $scope.promociones = data.data;
                    });
                    }else{
                        crudService.paginate('promociones',$scope.currentPage).then(function (data) {
                            $scope.promociones = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'promociones').then(function (data) {
                        $scope.promocion = data;
                        $scope.promocion.porcentajeDescuento=Number($scope.promocion.porcentajeDescuento);
                    });
                }else{
                    crudService.paginate('promociones',1).then(function (data) {
                        $scope.promociones = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                

                $scope.searchPromocion= function(){
                if ($scope.query.length > 0) {
                    crudService.search('promociones',$scope.query,1).then(function (data){
                        $scope.promociones = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('promociones',1).then(function (data) {
                        $scope.promociones = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createPromocion = function(){
                    if ($scope.promocionCreateForm.$valid) {
                        crudService.create($scope.promocion, 'promociones').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('Grabado correctamente');
                                $location.path('/promociones');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editPromocion = function(row){
                    $location.path('/promociones/edit/'+row.id);
                };

                $scope.updatePromocion = function(){

                    if ($scope.promocionEditForm.$valid) {
                        crudService.update($scope.promocion,'promociones').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('Editado correctamente');
                                $location.path('/promociones');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deletePromocion= function(row){
                    
                    $scope.promocion = row;
                }

                $scope.cancelPromocion = function(){
                    $scope.promocion = {};
                }

                $scope.destroyPromocion = function(){
                    crudService.destroy($scope.promocion,'promociones').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.promocion = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();

(function(){
    angular.module('paises.controllers',[])
        .controller('PaisController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.paises = [];
                $scope.pais = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('paises',$scope.query,$scope.currentPage).then(function (data){
                        $scope.paises = data.data;
                    });
                    }else{
                        crudService.paginate('paises',$scope.currentPage).then(function (data) {
                            $scope.paises = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'paises').then(function (data) {
                        $scope.pais = data;
                    });
                }else{
                    crudService.paginate('paises',1).then(function (data) {
                        $scope.paises = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                

                $scope.searchPais= function(){
                if ($scope.query.length > 0) {
                    crudService.search('paises',$scope.query,1).then(function (data){
                        $scope.paises = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('paises',1).then(function (data) {
                        $scope.paises = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createPais = function(){
                    if ($scope.paisCreateForm.$valid) {
                        crudService.create($scope.pais, 'paises').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('Grabado correctamente');
                                $location.path('/paises');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editPais = function(row){
                    $location.path('/paises/edit/'+row.id);
                };

                $scope.updatePais = function(){

                    if ($scope.paisEditForm.$valid) {
                        crudService.update($scope.pais,'paises').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('Editado correctamente');
                                $location.path('/paises');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deletePais= function(row){
                    
                    $scope.pais = row;
                }

                $scope.cancelPais = function(){
                    $scope.pais = {};
                }

                $scope.destroyPais = function(){ 
                    crudService.destroy($scope.pais,'paises').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.pais = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();

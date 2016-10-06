(function(){
    angular.module('bancos.controllers',[])
        .controller('BancoController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.bancos = [];
                $scope.banco = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('bancos',$scope.query,$scope.currentPage).then(function (data){
                        $scope.bancos = data.data;
                    });
                    }else{
                        crudService.paginate('bancos',$scope.currentPage).then(function (data) {
                            $scope.bancos = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'bancos').then(function (data) {
                        $scope.banco = data;
                    });
                }else{
                    crudService.paginate('bancos',1).then(function (data) {
                        $scope.bancos = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                

                $scope.searchBanco= function(){
                if ($scope.query.length > 0) {
                    crudService.search('bancos',$scope.query,1).then(function (data){
                        $scope.bancos = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('bancos',1).then(function (data) {
                        $scope.bancos = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createBanco = function(){
                    if ($scope.bancoCreateForm.$valid) {
                        crudService.create($scope.banco, 'bancos').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('Grabado correctamente');
                                $location.path('/bancos');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editBanco = function(row){
                    $location.path('/bancos/edit/'+row.id);
                };

                $scope.updateBanco = function(){

                    if ($scope.bancoEditForm.$valid) {
                        crudService.update($scope.banco,'bancos').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('Editado correctamente');
                                $location.path('/bancos');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteBanco= function(row){
                    
                    $scope.banco = row;
                }

                $scope.cancelBanco = function(){
                    $scope.banco = {};
                }

                $scope.destroyBanco = function(){
                    crudService.destroy($scope.banco,'bancos').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.banco = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();

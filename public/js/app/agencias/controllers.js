(function(){
    angular.module('agencias.controllers',[])
        .controller('AgenciaController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.agencias = [];
                $scope.agencia = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('agencias',$scope.query,$scope.currentPage).then(function (data){
                        $scope.agencias = data.data;
                    });
                    }else{
                        crudService.paginate('agencias',$scope.currentPage).then(function (data) {
                            $scope.agencias = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'agencias').then(function (data) {
                        $scope.agencia = data;
                    });
                }else{
                    crudService.paginate('agencias',1).then(function (data) {
                        $scope.agencias = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                

                $scope.searchAgencia= function(){
                if ($scope.query.length > 0) {
                    crudService.search('agencias',$scope.query,1).then(function (data){
                        $scope.agencias = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('agencias',1).then(function (data) {
                        $scope.agencias = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createAgencia= function(){
                    if ($scope.agenciaCreateForm.$valid) {
                        crudService.create($scope.agencia, 'agencias').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('Grabado correctamente');
                                $location.path('/agencias');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editAgencia= function(row){
                    $location.path('/agencias/edit/'+row.id);
                };

                $scope.updateAgencia= function(){

                    if ($scope.agenciaEditForm.$valid) {
                        crudService.update($scope.agencia,'agencias').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('Editado correctamente');
                                $location.path('/agencias');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteAgencia= function(row){
                    
                    $scope.agencia = row;
                }

                $scope.cancelAgencia = function(){
                    $scope.agencia = {};
                }

                $scope.destroyAgencia = function(){
                    crudService.destroy($scope.agencia,'agencias').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.agencia = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();

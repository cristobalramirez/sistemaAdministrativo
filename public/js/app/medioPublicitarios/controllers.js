(function(){
    angular.module('medioPublicitarios.controllers',[])
        .controller('MedioPublicitarioController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.medioPublicitarios = [];
                $scope.medioPublicitario = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('medioPublicitarios',$scope.query,$scope.currentPage).then(function (data){
                        $scope.medioPublicitarios = data.data;
                    });
                    }else{
                        crudService.paginate('medioPublicitarios',$scope.currentPage).then(function (data) {
                            $scope.medioPublicitarios = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'medioPublicitarios').then(function (data) {
                        $scope.medioPublicitario = data;
                    });
                }else{
                    crudService.paginate('medioPublicitarios',1).then(function (data) {
                        $scope.medioPublicitarios = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                

                $scope.searchMedioPublicitario= function(){
                if ($scope.query.length > 0) {
                    crudService.search('medioPublicitarios',$scope.query,1).then(function (data){
                        $scope.medioPublicitarios = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('medioPublicitarios',1).then(function (data) {
                        $scope.medioPublicitarios = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createMedioPublicitario = function(){
                    if ($scope.medioPublicitarioCreateForm.$valid) {
                        crudService.create($scope.medioPublicitario, 'medioPublicitarios').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('Grabado correctamente');
                                $location.path('/medioPublicitarios');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editMedioPublicitario = function(row){
                    $location.path('/medioPublicitarios/edit/'+row.id);
                };

                $scope.updateMedioPublicitario = function(){

                    if ($scope.medioPublicitarioEditForm.$valid) {
                        crudService.update($scope.medioPublicitario,'medioPublicitarios').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('Editado correctamente');
                                $location.path('/medioPublicitarios');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };
                $scope.deleteMedioPublicitario= function(row){
                    
                    $scope.medioPublicitario = row;
                }

                $scope.cancelMedioPublicitario = function(){
                    $scope.medioPublicitario = {};
                }

                $scope.destroyMedioPublicitario = function(){
                    crudService.destroy($scope.medioPublicitario,'medioPublicitarios').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.medioPublicitario = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();

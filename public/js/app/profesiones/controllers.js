(function(){
    angular.module('profesiones.controllers',[])
        .controller('ProfesionController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.profesiones = [];
                $scope.profesion = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('profesiones',$scope.query,$scope.currentPage).then(function (data){
                        $scope.profesiones = data.data;
                    });
                    }else{
                        crudService.paginate('profesiones',$scope.currentPage).then(function (data) {
                            $scope.profesiones = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'profesiones').then(function (data) {
                        $scope.profesion = data;
                    });
                }else{
                    crudService.paginate('profesiones',1).then(function (data) {
                        $scope.profesiones = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                

                $scope.searchProfesion= function(){
                if ($scope.query.length > 0) {
                    crudService.search('profesiones',$scope.query,1).then(function (data){
                        $scope.profesiones = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('profesiones',1).then(function (data) {
                        $scope.profesiones = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createProfesion = function(){
                    if ($scope.profesionCreateForm.$valid) {
                        $scope.profesion.orden=$scope.profesion.nombre;
                        crudService.create($scope.profesion, 'profesiones').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('Grabado correctamente');
                                $location.path('/profesiones');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editProfesion= function(row){
                    $location.path('/profesiones/edit/'+row.id);
                };

                $scope.updateProfesion = function(){

                    if ($scope.profesionEditForm.$valid) {
                        crudService.update($scope.profesion,'profesiones').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('Editado correctamente');
                                $location.path('/profesiones');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteProfesion= function(row){
                    
                    $scope.profesion = row;
                }

                $scope.cancelProfesion = function(){
                    $scope.profesion = {};
                }

                $scope.destroyProfesion = function(){
                    crudService.destroy($scope.profesion,'profesiones').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.profesion = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();

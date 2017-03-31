(function(){
    angular.module('especialidades.controllers',[])
        .controller('EspecialidadController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.especialidades = [];
                $scope.especialidad = {};
                $scope.categorias = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('especialidades',$scope.query,$scope.currentPage).then(function (data){
                        $scope.especialidades = data.data;
                    });
                    }else{
                        crudService.paginate('especialidades',$scope.currentPage).then(function (data) {
                            $scope.especialidades = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'especialidades').then(function (data) {
                        $scope.especialidad = data;
                    });

                    crudService.all('cargarCategorias').then(function (data) {
                        $scope.categorias = data;
                    });
                }else{
                    crudService.paginate('especialidades',1).then(function (data) {
                        $scope.especialidades = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                    crudService.all('cargarCategorias').then(function (data) {
                        $scope.categorias = data;
                    });
                }

                

                $scope.searchEspecialidad= function(){
                if ($scope.query.length > 0) {
                    crudService.search('especialidades',$scope.query,1).then(function (data){
                        $scope.especialidades = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('especialidades',1).then(function (data) {
                        $scope.especialidades = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createEspecialidad = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.especialidadCreateForm.$valid) {
                            crudService.create($scope.especialidad, 'especialidades').then(function (data) {
                          
                                if (data['estado'] == true) {
                                    $scope.success = data['nombres'];
                                    alert('Grabado correctamente');
                                    $location.path('/especialidades');

                                } else {
                                    $scope.errors = data;

                                }
                            });
                    }
                }


                $scope.editEspecialidad= function(row){
                    $location.path('/especialidades/edit/'+row.id);
                };

                $scope.updateEspecialidad = function(){

                    if ($scope.especialidadEditForm.$valid) {
                            crudService.update($scope.especialidad,'especialidades').then(function(data)
                            {
                                if(data['estado'] == true){
                                    $scope.success = data['nombres'];
                                    alert('Editado correctamente');
                                    $location.path('/especialidades');
                                }else{
                                    $scope.errors =data;
                                }
                            });
                        
                    }
                };

                $scope.deleteEspecialidad= function(row){
                    
                    $scope.especialidad = row;
                }

                $scope.cancelEspecialidad = function(){
                    $scope.especialidad = {};
                }

                $scope.destroyEspecialidad = function(){
                    crudService.destroy($scope.especialidad,'especialidades').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.especialidad = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();

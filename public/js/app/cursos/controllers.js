(function(){
    angular.module('cursos.controllers',[])
        .controller('CursoController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.cursos = [];
                $scope.curso = {};
                $scope.categorias = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('cursos',$scope.query,$scope.currentPage).then(function (data){
                        $scope.cursos = data.data;
                    });
                    }else{
                        crudService.paginate('cursos',$scope.currentPage).then(function (data) {
                            $scope.cursos = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'cursos').then(function (data) {
                        $scope.curso = data;
                    });

                    crudService.all('cargarCategorias').then(function (data) {
                        $scope.categorias = data;
                    });
                }else{
                    crudService.paginate('cursos',1).then(function (data) {
                        $scope.cursos = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                    crudService.all('cargarCategorias').then(function (data) {
                        $scope.categorias = data;
                    });
                }

                

                $scope.searchCurso= function(){
                if ($scope.query.length > 0) {
                    crudService.search('cursos',$scope.query,1).then(function (data){
                        $scope.cursos = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('cursos',1).then(function (data) {
                        $scope.cursos = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createCurso = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.cursoCreateForm.$valid) {
                            crudService.create($scope.curso, 'cursos').then(function (data) {
                          
                                if (data['estado'] == true) {
                                    $scope.success = data['nombres'];
                                    alert('Grabado correctamente');
                                    $location.path('/cursos');

                                } else {
                                    $scope.errors = data;

                                }
                            });
                    }
                }


                $scope.editCurso = function(row){
                    $location.path('/cursos/edit/'+row.id);
                };

                $scope.updateCurso = function(){

                    if ($scope.cursoEditForm.$valid) {
                            crudService.update($scope.curso,'cursos').then(function(data)
                            {
                                if(data['estado'] == true){
                                    $scope.success = data['nombres'];
                                    alert('Editado correctamente');
                                    $location.path('/cursos');
                                }else{
                                    $scope.errors =data;
                                }
                            });
                        
                    }
                };

                $scope.deleteCurso= function(row){
                    
                    $scope.curso = row;
                }

                $scope.cancelCurso = function(){
                    $scope.curso = {};
                }

                $scope.destroyCurso = function(){
                    crudService.destroy($scope.curso,'cursos').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.curso = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();

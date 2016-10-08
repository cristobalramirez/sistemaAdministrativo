(function(){
    angular.module('categorias.controllers',[])
        .controller('CategoriaController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.categorias = [];
                $scope.categoria = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('categorias',$scope.query,$scope.currentPage).then(function (data){
                        $scope.categorias = data.data;
                    });
                    }else{
                        crudService.paginate('categorias',$scope.currentPage).then(function (data) {
                            $scope.categorias = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'categorias').then(function (data) {
                        $scope.categoria = data;
                    });
                }else{
                    crudService.paginate('categorias',1).then(function (data) {
                        $scope.categorias = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                

                $scope.searchCategoria= function(){
                if ($scope.query.length > 0) {
                    crudService.search('categorias',$scope.query,1).then(function (data){
                        $scope.categorias = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('categorias',1).then(function (data) {
                        $scope.categorias = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createCategoria = function(){
                    if ($scope.categoriaCreateForm.$valid) {
                        crudService.create($scope.categoria, 'categorias').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('Grabado correctamente');
                                $location.path('/categorias');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editCategoria = function(row){
                    $location.path('/categorias/edit/'+row.id);
                };

                $scope.updateCategoria = function(){

                    if ($scope.categoriaEditForm.$valid) {
                        crudService.update($scope.categoria,'categorias').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('Editado correctamente');
                                $location.path('/categorias');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteCategoria= function(row){
                    
                    $scope.categoria = row;
                }

                $scope.cancelCategoria = function(){
                    $scope.categoria = {};
                }

                $scope.destroyCategoria = function(){
                    crudService.destroy($scope.categoria,'categorias').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.categoria = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();

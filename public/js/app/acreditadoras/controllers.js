 (function(){
    angular.module('acreditadoras.controllers',[])
        .controller('AcreditadoraController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.acreditadoras = [];
                $scope.acreditadora = {};
                $scope.departamentos ={};
                $scope.depertamentoSelect;
                $scope.provincias ={};
                $scope.provinciaSelect;
                $scope.distritos ={};
                $scope.distritoSelect;
                $scope.errors = null;
                $scope.ubigeo ={};
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () { 
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('acreditadoras',$scope.query,$scope.currentPage).then(function (data){
                        $scope.acreditadoras = data.data;
                    });
                    }else{
                        crudService.paginate('acreditadoras',$scope.currentPage).then(function (data) {
                            $scope.acreditadoras = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'acreditadoras').then(function (data) {
                        $scope.acreditadora = data;
                        crudService.byId($scope.acreditadora.ubigeo_id,'ubigeos').then(function (data) {
                            $scope.ubigeo = data;
                            crudService.all('ubigeoDepartamento').then(function(data){  
                                $scope.departamentos = data;
                                $scope.depertamentoSelect=$scope.ubigeo.departamento;
                            });
                            crudService.recuperarUnDato('ubigeoProvincia',$scope.ubigeo.departamento).then(function(data){  
                                $scope.provincias = data;
                                $scope.provinciaSelect=$scope.ubigeo.provincia;;
                            });
                            crudService.recuperarDosDato('ubigeoDistrito',$scope.ubigeo.departamento,$scope.ubigeo.provincia).then(function(data){  
                                $scope.distritos = data;
                                $scope.distritoSelect=$scope.ubigeo.id;
                            });
                        });
                    });
                    
                    

                }else{
                    crudService.paginate('acreditadoras',1).then(function (data) {
                        $scope.acreditadoras = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                    //-------------------------------------------------------------
                    
                    crudService.all('ubigeoDepartamento').then(function(data){  
                        $scope.departamentos = data;
                        //$scope.depertamentoSelect=data[0].departamento;
                    });
                    
                }

                

                $scope.searchAcreditadora = function(){
                if ($scope.query.length > 0) {
                    crudService.search('acreditadoras',$scope.query,1).then(function (data){
                        $scope.acreditadoras = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('acreditadoras',1).then(function (data) {
                        $scope.acreditadoras = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createAcreditadora = function(){
                    if ($scope.acreditadoraCreateForm.$valid) {
                            $scope.acreditadora.ubigeo_id=$scope.distritoSelect;
                            crudService.create($scope.acreditadora, 'acreditadoras').then(function (data) {
                          
                                if (data['estado'] == true) {
                                 $scope.success = data['nombres'];
                                    alert('Grabado correctamente');
                                    $location.path('/acreditadoras');

                                } else {
                                    $scope.errors = data;

                                }
                            });
                    }
                }


                $scope.editAcreditadora = function(row){
                    $location.path('/acreditadoras/edit/'+row.id);
                };

                $scope.updateAcreditadora = function(){

                    if ($scope.acreditadoraEditForm.$valid) {
                            $scope.acreditadora.ubigeo_id=$scope.distritoSelect;

                            crudService.update($scope.acreditadora,'acreditadoras').then(function(data)
                            {
                                if(data['estado'] == true){
                                    $scope.success = data['nombres'];
                                    alert('Editado correctamente');
                                    $location.path('/acreditadoras');
                                }else{
                                    $scope.errors =data;
                                }
                            });
                    }
                };

                $scope.deleteAcreditadora= function(row){
                    
                    $scope.acreditadora = row;
                }

                $scope.cancelAcreditadora = function(){
                    $scope.acreditadora = {};
                }

                $scope.destroyAcreditadora = function(){
                    crudService.destroy($scope.acreditadora,'acreditadoras').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.acreditadora = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
                $scope.cargarProvincia = function(){
                    $scope.provincias ={};
                    $scope.provinciaSelect=null;
                    $scope.distritoSelect=null;
                    crudService.recuperarUnDato('ubigeoProvincia',$scope.depertamentoSelect).then(function(data){  
                        $scope.provincias = data;
                        //$scope.provinciaSelect=data[0].provincia;
                    });
                }
                $scope.cargarDistrito = function(){
                    $scope.distritos ={};
                    $scope.distritoSelect=null;
                    crudService.recuperarDosDato('ubigeoDistrito',$scope.depertamentoSelect,$scope.provinciaSelect).then(function(data){  
                        $scope.distritos = data;
                        
                    });
                }


            }]);
})();

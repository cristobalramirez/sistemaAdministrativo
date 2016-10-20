 (function(){
    angular.module('empleados.controllers',[])
        .controller('EmpleadoController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.empleados = [];
                $scope.empleado = {};
                //----------------------
                $scope.Departamentos ={};
                $scope.DepertamentoSelect;
                $scope.Provincias ={};
                $scope.ProvinciaSelect;
                $scope.Distritos ={};
                $scope.DistritoSelect;
                $scope.dniEditar;
                //$scope.file="";
                //----------------------
                $scope.errors = null;
                $scope.ubigeo ={};
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () { 
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('empleados',$scope.query,$scope.currentPage).then(function (data){
                        $scope.empleados = data.data;
                    });
                    }else{
                        crudService.paginate('empleados',$scope.currentPage).then(function (data) {
                            $scope.empleados = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'empleados').then(function (data) {
                        $scope.empleado = data;
                        $scope.empleado.dni=Number($scope.empleado.dni);
                        $scope.dniEditar=$scope.empleado.dni;
                        $scope.empleado.telefono=Number($scope.empleado.telefono); 
                        if($scope.empleado != null) {
                            if ($scope.empleado.fechaNac.length > 0) {
                                $scope.empleado.fechaNac = new Date($scope.empleado.fechaNac);
                            }
                            if ($scope.empleado.fecIngreso.length > 0) {
                                $scope.empleado.fecIngreso = new Date($scope.empleado.fecIngreso);
                            }
                            if ($scope.empleado.fecBaja.length > 0) {
                                $scope.empleado.fecBaja = new Date($scope.empleado.fecBaja);
                            }
                        }

                        crudService.byId($scope.empleado.ubigeo_id,'ubigeos').then(function (data) {
                            $scope.ubigeo = data;
                            crudService.all('ubigeoDepartamento').then(function(data){  
                                $scope.Departamentos = data;
                                $scope.DepertamentoSelect=$scope.ubigeo.departamento;
                            });
                            crudService.recuperarUnDato('ubigeoProvincia',$scope.ubigeo.departamento).then(function(data){  
                                $scope.Provincias = data;
                                $scope.ProvinciaSelect=$scope.ubigeo.provincia;;
                            });
                            crudService.recuperarDosDato('ubigeoDistrito',$scope.ubigeo.departamento,$scope.ubigeo.provincia).then(function(data){  
                                $scope.Distritos = data;
                                $scope.DistritoSelect=$scope.ubigeo.id;
                            });
                        });

                    });

                }else{
                    crudService.paginate('empleados',1).then(function (data) {
                        $scope.empleados = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                    //-------------------------------------------------------------
                    
                    crudService.all('ubigeoDepartamento').then(function(data){  
                        $scope.Departamentos = data;
                    });
                }

                

                $scope.searchDocente = function(){
                if ($scope.query.length > 0) {
                    crudService.search('empleados',$scope.query,1).then(function (data){
                        $scope.empleados = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('empleados',1).then(function (data) {
                        $scope.empleados = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createEmpleado= function(){
                            $scope.empleado.ubigeo_id=$scope.DistritoSelect;
                            $scope.empleado.estado="Activo";
                                crudService.create($scope.empleado, 'empleados').then(function (data) {
                                    
                                    if (data['estado'] == true) {
                                    $scope.success = data['nombres'];
                                        alert('Grabado correctamente');
                                        $location.path('/empleados');

                                    } else {
                                        $scope.errors = data;

                                    }
                                });
        
                        
                }


                $scope.editEmpleado = function(row){
                    $location.path('/empleados/edit/'+row.id);
                };

                $scope.updateEmpleado = function(){
                                $scope.empleado.ubigeo_id=$scope.DistritoSelect;
                                crudService.update($scope.empleado,'empleados').then(function(data)
                                {
                                    if(data['estado'] == true){
                                        $scope.success = data['nombres'];
                                        alert('Editado correctamente');
                                        $location.path('/empleados');
                                    }else{
                                        $scope.errors =data;
                                    }
                                });
                        
                };

                $scope.deleteEmpleado = function(row){
                    
                    $scope.empleado = row;
                }

                $scope.cancelEmpleado = function(){
                    $scope.empleado = {};
                }

                $scope.destroyEmpleado = function(){
                    crudService.destroy($scope.empleado,'empleados').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.empleado = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
                $scope.CargarProvincia = function(){
                    $scope.Provincias ={};
                    $scope.ProvinciaSelect=null;
                    $scope.DistritoSelect=null;
                    crudService.recuperarUnDato('ubigeoProvincia',$scope.DepertamentoSelect).then(function(data){  
                        $scope.Provincias = data;
                        //$scope.provinciaSelect=data[0].provincia;
                    });
                }
                $scope.CargarDistrito = function(){
                    $scope.Distritos ={};
                    $scope.DistritoSelect=null;
                    crudService.recuperarDosDato('ubigeoDistrito',$scope.DepertamentoSelect,$scope.ProvinciaSelect).then(function(data){  
                        $scope.Distritos = data;
                    });
                }
                
                $scope.validaDni=function(texto){

                   if(texto!=undefined){
                        if ($scope.dniEditar!=texto) {
                            crudService.validar('empleados',texto).then(function (data){
                                if(data.dni!=undefined){
                                    alert("DNI Registrado!!");
                                    $scope.empleado.dni='';
                                }
                            });
                        }
                        
                    }
               }
               $scope.disableProduct = function(row){
                    crudService.byforeingKey('empleados','disablePersona',row.id).then(function(data)
                    {
                        if(data['estado'] == true){
                            $route.reload();
                        }else{
                            alert('No se pudo cambiar el estado');
                        }
                    });
                }

            }]);
})();

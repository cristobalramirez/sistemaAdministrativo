 (function(){
    angular.module('personas.controllers',[])
        .controller('PersonaController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.personas = [];
                $scope.persona = {};
                //----------------------
                $scope.TrabajoDepartamentos ={};
                $scope.TrabajoDepertamentoSelect;
                $scope.TrabajoProvincias ={};
                $scope.TrabajoProvinciaSelect;
                $scope.TrabajoDistritos ={};
                $scope.TrabajoDistritoSelect;
                //----------------------
                $scope.DomicilioDepartamentos ={};
                $scope.DomicilioDepertamentoSelect;
                $scope.DomicilioProvincias ={};
                $scope.DomicilioProvinciaSelect;
                $scope.DomicilioDistritos ={};
                $scope.DomicilioDistritoSelect;
                //----------------------
                $scope.profesiones={};
                $scope.errors = null;
                $scope.ubigeoTrabajo ={};
                $scope.ubigeoDomicilio ={};
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () { 
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('personas',$scope.query,$scope.currentPage).then(function (data){
                        $scope.personas = data.data;
                    });
                    }else{
                        crudService.paginate('personas',$scope.currentPage).then(function (data) {
                            $scope.personas = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'personas').then(function (data) {
                        $scope.persona = data;
                        
                        if($scope.persona != null) {
                            if ($scope.persona.fechaNac.length > 0) {
                                $scope.persona.fechaNac = new Date($scope.persona.fechaNac);
                            }
                        }

                        crudService.byId($scope.persona.ubigeoTrabajo_id,'ubigeos').then(function (data) {
                            $scope.ubigeoTrabajo = data;
                            crudService.all('ubigeoDepartamento').then(function(data){  
                                $scope.TrabajoDepartamentos = data;
                                $scope.TrabajoDepertamentoSelect=$scope.ubigeoTrabajo.departamento;
                            });
                            crudService.recuperarUnDato('ubigeoProvincia',$scope.ubigeoTrabajo.departamento).then(function(data){  
                                $scope.TrabajoProvincias = data;
                                $scope.TrabajoProvinciaSelect=$scope.ubigeoTrabajo.provincia;;
                            });
                            crudService.recuperarDosDato('ubigeoDistrito',$scope.ubigeoTrabajo.departamento,$scope.ubigeoTrabajo.provincia).then(function(data){  
                                $scope.TrabajoDistritos = data;
                                $scope.TrabajoDistritoSelect=$scope.ubigeoTrabajo.id;
                            });
                        });

                        crudService.byId($scope.persona.ubigeoDireccion_id,'ubigeos').then(function (data) {
                            $scope.ubigeoDomicilio = data;
                            crudService.all('ubigeoDepartamento').then(function(data){  
                                $scope.DomicilioDepartamentos = data;
                                $scope.DomicilioDepertamentoSelect=$scope.ubigeoDomicilio.departamento;
                            });
                            crudService.recuperarUnDato('ubigeoProvincia',$scope.ubigeoDomicilio.departamento).then(function(data){  
                                $scope.DomicilioProvincias = data;
                                $scope.DomicilioProvinciaSelect=$scope.ubigeoDomicilio.provincia;;
                            });
                            crudService.recuperarDosDato('ubigeoDistrito',$scope.ubigeoDomicilio.departamento,$scope.ubigeoDomicilio.provincia).then(function(data){  
                                $scope.DomicilioDistritos = data;
                                $scope.DomicilioDistritoSelect=$scope.ubigeoDomicilio.id;
                            });
                        });



                    });
                    
                    crudService.all('cargarProfesiones').then(function(data){  
                        $scope.profesiones = data;
                    });

                }else{
                    crudService.paginate('personas',1).then(function (data) {
                        $scope.personas = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                    //-------------------------------------------------------------
                    
                    crudService.all('ubigeoDepartamento').then(function(data){  
                        $scope.TrabajoDepartamentos = data;
                        $scope.DomicilioDepartamentos = data;
                    });
                    
                    crudService.all('cargarProfesiones').then(function(data){  
                        $scope.profesiones = data;
                    });
                }

                

                $scope.searchPersona = function(){
                if ($scope.query.length > 0) {
                    crudService.search('personas',$scope.query,1).then(function (data){
                        $scope.personas = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('personas',1).then(function (data) {
                        $scope.personas = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createPersona = function(){
                    //$scope.atribut.estado = 1;
                    $log.log($scope.persona);
                    if ($scope.personaCreateForm.$valid) {
                        if($scope.TrabajoDistritoSelect!=null){
                            if($scope.DomicilioDistritoSelect!=null){
                                $scope.persona.ubigeoTrabajo_id=$scope.TrabajoDistritoSelect;
                                $scope.persona.ubigeoDireccion_id=$scope.DomicilioDistritoSelect;
                                $scope.persona.estado="Activo";
                                crudService.create($scope.persona, 'personas').then(function (data) {
                          
                                    if (data['estado'] == true) {
                                    $scope.success = data['nombres'];
                                        alert('grabado correctamente');
                                        $location.path('/personas');

                                    } else {
                                        $scope.errors = data;

                                    }
                                });
                            }else{
                                alert('Selecione Direcion de Domicilio Correctamente');  
                            }
                        }else{
                            alert('Selecione Direcion de Trabajo Correctamente');
                        }
                    }
                }


                $scope.editPersona = function(row){
                    $location.path('/personas/edit/'+row.id);
                };

                $scope.updatePersona = function(){

                    if ($scope.PersonaEditForm.$valid) {
                        if($scope.TrabajoDistritoSelect!=null){
                            if($scope.DomicilioDistritoSelect!=null){
                                $scope.persona.ubigeoTrabajo_id=$scope.TrabajoDistritoSelect;
                                $scope.persona.ubigeoDireccion_id=$scope.DomicilioDistritoSelect;
                                crudService.update($scope.persona,'personas').then(function(data)
                                {
                                    if(data['estado'] == true){
                                        $scope.success = data['nombres'];
                                        alert('editado correctamente');
                                        $location.path('/personas');
                                    }else{
                                        $scope.errors =data;
                                    }
                                });
                         }else{
                                alert('Selecione Direcion de Domicilio Correctamente');  
                            }
                        }else{
                            alert('Selecione Direcion de Trabajo Correctamente');
                        }
                    }
                };

                $scope.deletePersona= function(row){
                    
                    $scope.persona = row;
                }

                $scope.cancelPersona = function(){
                    $scope.persona = {};
                }

                $scope.destroyPersona = function(){
                    crudService.destroy($scope.persona,'personas').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.persona = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
                $scope.TrabajoCargarProvincia = function(){
                    $scope.TrabajoProvincias ={};
                    $scope.TrabajoProvinciaSelect=null;
                    $scope.TrabajoDistritoSelect=null;
                    crudService.recuperarUnDato('ubigeoProvincia',$scope.TrabajoDepertamentoSelect).then(function(data){  
                        $scope.TrabajoProvincias = data;
                        //$scope.provinciaSelect=data[0].provincia;
                    });
                }
                $scope.TrabajoCargarDistrito = function(){
                    $scope.TrabajoDistritos ={};
                    $scope.TrabajoDistritoSelect=null;
                    crudService.recuperarDosDato('ubigeoDistrito',$scope.TrabajoDepertamentoSelect,$scope.TrabajoProvinciaSelect).then(function(data){  
                        $scope.TrabajoDistritos = data;
                        $log.log($scope.TrabajoDistritos);
                    });
                }
                $scope.DomicilioCargarProvincia = function(){
                    $scope.DomicilioProvincias ={};
                    $scope.DomicilioProvinciaSelect=null;
                    $scope.DomicilioDistritoSelect=null;
                    crudService.recuperarUnDato('ubigeoProvincia',$scope.DomicilioDepertamentoSelect).then(function(data){  
                        $scope.DomicilioProvincias = data;
                        //$scope.provinciaSelect=data[0].provincia;
                    });
                }
                $scope.DomicilioCargarDistrito = function(){
                    $scope.DomicilioDistritos ={};
                    $scope.DomicilioDistritoSelect=null;
                    crudService.recuperarDosDato('ubigeoDistrito',$scope.DomicilioDepertamentoSelect,$scope.DomicilioProvinciaSelect).then(function(data){  
                        $scope.DomicilioDistritos = data;
                        
                    });
                }
                $scope.validaDni=function(texto){

                   if(texto!=undefined){

                        crudService.validar('personas',texto).then(function (data){
                            $log.log(data);
                            if(data.dni!=undefined){
                                alert("DNI Registrado!!");
                                $scope.persona.dni='';
                            }
                        });
                    }
               }
               $scope.disableProduct = function(row){
                    //$log.log(row);
                    crudService.byforeingKey('personas','disablePersona',row.id).then(function(data)
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

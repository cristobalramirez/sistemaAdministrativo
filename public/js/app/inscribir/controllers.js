(function(){
    angular.module('inscribir.controllers',[])
        .controller('InscribirController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.edicion = {};
                $scope.curso = {};
                $scope.persona = {};
                $scope.inscribir = {};
                $scope.persona.pais_id = "1";
                $scope.persona.sexo="Masculino";
                //----------------------
                $scope.TrabajoDepartamentos ={};
                $scope.persona.TrabajoDepertamentoSelect;
                $scope.TrabajoProvincias ={};
                $scope.persona.TrabajoProvinciaSelect;
                $scope.TrabajoDistritos ={};
                $scope.persona.TrabajoDistritoSelect;
                //----------------------
                $scope.DomicilioDepartamentos ={};
                $scope.persona.DomicilioDepertamentoSelect;
                $scope.DomicilioProvincias ={};
                $scope.persona.DomicilioProvinciaSelect;
                $scope.DomicilioDistritos ={};
                $scope.persona.DomicilioDistritoSelect;
                //----------------------
                $scope.ubigeoTrabajo ={};
                $scope.ubigeoDomicilio ={};

                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'ediciones').then(function (data) {
                        $scope.edicion = data;
                        if ($scope.edicion.costoCurso!=undefined) {
                            crudService.byId($scope.edicion.curso_id,'cursos').then(function (data) {
                                $scope.curso = data;
                            });    
                            crudService.search('detalleDocenteEdiciones',$scope.edicion.id,1).then(function (data){
                                $scope.docentesAdd=data;
                            });

                            if($scope.edicion != null) {
                                if ($scope.edicion.fechaInicio.length > 0) {
                                    $scope.edicion.fechaInicio = new Date($scope.edicion.fechaInicio);
                                }
                                if ($scope.edicion.fechaFin.length > 0) {
                                    $scope.edicion.fechaFin = new Date($scope.edicion.fechaFin);
                                } 
                            }
                        }
                    });

                    crudService.all('ubigeoDepartamento').then(function(data){  
                        $scope.TrabajoDepartamentos = data;
                        $scope.DomicilioDepartamentos = data;
                    });
                    
                    crudService.all('cargarProfesiones').then(function(data){  
                        $scope.profesiones = data;
                    });
                    crudService.all('cargarMedioPublicitarios').then(function(data){  
                        $scope.medioPublicitarios = data;
                    });
                    crudService.all('cargarPaises').then(function(data){  
                        $scope.paises = data;
                    });
                }
                $scope.createInscripcion = function(){
                    crudService.recuperarDosDato('buscarInscripcion',$scope.edicion.id,$scope.persona.id).then(function(data){  
                        if (data.length>0) {
                            alert("Usted ya se encuentra registrado en este curso");
                        }else{
                            $scope.persona.ubigeoTrabajo_id=$scope.persona.TrabajoDistritoSelect;
                                $scope.persona.ubigeoDireccion_id=$scope.persona.DomicilioDistritoSelect;
                                $scope.persona.estado="Activo";

                                $scope.inscribir.persona = $scope.persona;
                                $scope.inscribir.estado=0;
                                $scope.inscribir.fechaInscripcion
                                $scope.inscribir.montoCurso=$scope.edicion.costoCurso;
                                $scope.inscribir.montoPagado=0;
                                $scope.inscribir.descuentoPorcentaje=0;
                                $scope.inscribir.descuento=0;
                                $scope.inscribir.montoPagar=$scope.edicion.costoCurso;
                                $scope.inscribir.saldo=$scope.edicion.costoCurso;
                                $scope.inscribir.edicion_id=$scope.edicion.id;
                                $scope.inscribir.nombres=$scope.persona.nombres;
                                $scope.inscribir.apellidos=$scope.persona.apellidos;
                                $scope.inscribir.dni=$scope.persona.dni;
                                $scope.inscribir.email=$scope.persona.email;
                                $scope.inscribir.telefono=$scope.persona.telefono;
                                $scope.inscribir.promocion_id=1;
                                $scope.fechaInscripcion=new Date();

                                crudService.create($scope.inscribir, 'inscribir').then(function (data) {
                          
                                    if (data['estado'] == true) {
                                    $scope.success = data['nombres'];
                                        alert('Registrado corretamente correctamente');
                                        $route.reload();

                                    } else {
                                        $scope.errors = data;

                                    }
                                });
                        }

                                
                    });

                    
                                
                        
                    //}
                }

                $scope.TrabajoCargarProvincia = function(){
                    $scope.TrabajoProvincias ={};
                    $scope.persona.TrabajoProvinciaSelect=null;
                    $scope.persona.TrabajoDistritoSelect=null;
                    crudService.recuperarUnDato('ubigeoProvincia',$scope.persona.TrabajoDepertamentoSelect).then(function(data){  
                        $scope.TrabajoProvincias = data;
                    });
                }
                $scope.TrabajoCargarDistrito = function(){
                    $scope.TrabajoDistritos ={};
                    $scope.persona.TrabajoDistritoSelect=null;
                    crudService.recuperarDosDato('ubigeoDistrito',$scope.persona.TrabajoDepertamentoSelect,$scope.persona.TrabajoProvinciaSelect).then(function(data){  
                        $scope.TrabajoDistritos = data;
                    });
                    
                }
                $scope.DomicilioCargarProvincia = function(){
                    $scope.DomicilioProvincias ={};
                    $scope.persona.DomicilioProvinciaSelect=null;
                    $scope.persona.DomicilioDistritoSelect=null;
                    crudService.recuperarUnDato('ubigeoProvincia',$scope.persona.DomicilioDepertamentoSelect).then(function(data){  
                        $scope.DomicilioProvincias = data;
                    });
                }
                $scope.DomicilioCargarDistrito = function(){
                    $scope.DomicilioDistritos ={};
                    $scope.persona.DomicilioDistritoSelect=null;
                    crudService.recuperarDosDato('ubigeoDistrito',$scope.persona.DomicilioDepertamentoSelect,$scope.persona.DomicilioProvinciaSelect).then(function(data){  
                        $scope.DomicilioDistritos = data;
                        
                    });
                }

                $scope.validarPais = function(){
                    $scope.persona.direccion=null;
                    $scope.persona.DomicilioDepertamentoSelect=null;
                    $scope.persona.DomicilioProvinciaSelect=null;
                    $scope.persona.DomicilioDistritoSelect=null;
                    $scope.persona.TrabajoDepertamentoSelect=null;
                    $scope.persona.TrabajoProvinciaSelect=null;
                    $scope.persona.TrabajoDistritoSelect=null;
                }

                $scope.buscarPersonaDni = function(dato){
                    crudService.recuperarUnDato('buscarPersonaConDni',dato).then(function(data){  
                        $scope.persona = data[0];
                        if($scope.persona != null) {
                            if ($scope.persona.fechaNac.length > 0) {
                                $scope.persona.fechaNac = new Date($scope.persona.fechaNac);
                            }
                        }
                        if ($scope.persona!=null) {
                        crudService.byId($scope.persona.ubigeoTrabajo_id,'ubigeos').then(function (data) {
                            $scope.ubigeoTrabajo = data;
                            crudService.all('ubigeoDepartamento').then(function(data){  
                                $scope.TrabajoDepartamentos = data;
                                $scope.persona.TrabajoDepertamentoSelect=$scope.ubigeoTrabajo.departamento;
                            });
                            crudService.recuperarUnDato('ubigeoProvincia',$scope.ubigeoTrabajo.departamento).then(function(data){  
                                $scope.TrabajoProvincias = data;
                                $scope.persona.TrabajoProvinciaSelect=$scope.ubigeoTrabajo.provincia;;
                            });
                            crudService.recuperarDosDato('ubigeoDistrito',$scope.ubigeoTrabajo.departamento,$scope.ubigeoTrabajo.provincia).then(function(data){  
                                $scope.TrabajoDistritos = data;
                                $scope.persona.TrabajoDistritoSelect=$scope.ubigeoTrabajo.id;
                            });
                        });

                        crudService.byId($scope.persona.ubigeoDireccion_id,'ubigeos').then(function (data) {
                            $scope.ubigeoDomicilio = data;
                            crudService.all('ubigeoDepartamento').then(function(data){  
                                $scope.DomicilioDepartamentos = data;
                                $scope.persona.DomicilioDepertamentoSelect=$scope.ubigeoDomicilio.departamento;
                            });
                            crudService.recuperarUnDato('ubigeoProvincia',$scope.ubigeoDomicilio.departamento).then(function(data){  
                                $scope.DomicilioProvincias = data;
                                $scope.persona.DomicilioProvinciaSelect=$scope.ubigeoDomicilio.provincia;;
                            });
                            crudService.recuperarDosDato('ubigeoDistrito',$scope.ubigeoDomicilio.departamento,$scope.ubigeoDomicilio.provincia).then(function(data){  
                                $scope.DomicilioDistritos = data;
                                $scope.persona.DomicilioDistritoSelect=$scope.ubigeoDomicilio.id;
                            });
                        });
                        $scope.persona.dni=Number($scope.persona.dni);
                        }else{
                            $scope.persona={};
                            $scope.persona.dni=dato;
                            $scope.persona.id=0;
                            $scope.persona.sexo="Masculino";
                            $scope.persona.pais_id = "1";
                        }
                    });
                }

                
            }]);
})();

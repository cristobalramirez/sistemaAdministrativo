(function(){
    angular.module('inscripciones.controllers',[])
        .controller('InscripcionController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.inscripciones = [];
                $scope.inscripcion = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.medioPublicitarios={};
                $scope.promociones={};
                $scope.empleados={};
                $scope.promocion={};
                $scope.inscripcion.descuentoPorcentaje=0;
                $scope.inscripcion.descuento=0;
                $scope.inscripcion.nombreMedio;
                $scope.inscripcion.nombreCurso;
                $scope.inscripcion.nombrePromocion;

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('inscripciones',$scope.query,$scope.currentPage).then(function (data){
                        $scope.inscripciones = data.data;
                    });
                    }else{
                        crudService.paginate('inscripciones',$scope.currentPage).then(function (data) {
                            $scope.inscripciones = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                { 
                    crudService.byId(id,'inscripciones').then(function (data) {
                        $scope.inscripcion = data;
                        crudService.byId($scope.inscripcion.medioPublicitario_id,'medioPublicitarios').then(function (data) {
                            $scope.inscripcion.nombreMedio=data.descripcion;
                        });
                        crudService.byId($scope.inscripcion.promocion_id,'promociones').then(function (data) {
                            $scope.inscripcion.nombrePromocion=data.descripcion;
                        });
                        crudService.byId($scope.inscripcion.edicion_id,'ediciones').then(function (data) {
                            var edicionSelecionada=data;
                            crudService.byId(edicionSelecionada.curso_id,'cursos').then(function (data) {
                                $scope.inscripcion.nombreCurso=data.descripcion;
                                

                                crudService.byId(edicionSelecionada.curso_id,'acreditadoras').then(function (data) {
                                    $scope.inscripcion.nombreCurso=$scope.inscripcion.nombreCurso+" - "+data.nombre;
                                    $log.log($scope.inscripcion.nombreCurso);
                                });    
                            });
                        });

                        
                    });
                    crudService.all('cargarMedioPublicitarios').then(function(data){  
                        $scope.medioPublicitarios = data;
                    });
                    crudService.all('cargarPromociones').then(function(data){  
                        $scope.promociones = data;
                    });
                    crudService.all('cargarEmpleados').then(function(data){  
                        $scope.empleados = data;
                    });
                }else{
                    $scope.inscripcion.promocion_id="1";
                    crudService.paginate('inscripciones',1).then(function (data) {
                        $scope.inscripciones = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                    
                    crudService.all('cargarPromociones').then(function(data){  
                        $scope.promociones = data;
                    });
                    crudService.all('cargarEmpleados').then(function(data){  
                        $scope.empleados = data;
                    });
                    crudService.all('cargarMedioPublicitarios').then(function(data){  
                        $scope.medioPublicitarios = data;
                    });

                }

                

                $scope.searchInscripcion= function(){
                if ($scope.query.length > 0) {
                    crudService.search('inscripciones',$scope.query,1).then(function (data){
                        $scope.inscripciones = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('inscripciones',1).then(function (data) {
                        $scope.inscripciones = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createInscripcion = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.inscripcionCreateForm.$valid) {
                        $scope.inscripcion.montoPagado=0;
                        $scope.inscripcion.saldo=$scope.inscripcion.montoPagar-$scope.inscripcion.montoPagado;
                        $scope.inscripcion.estado=0;
                        if ($scope.inscripcion.edicion_id!=undefined) {
                            if ($scope.inscripcion.persona_id!=undefined) {
                                crudService.create($scope.inscripcion, 'inscripciones').then(function (data) {
                          
                                    if (data['estado'] == true) {
                                        $scope.success = data['nombres'];
                                        alert('Grabado correctamente');
                                        $location.path('/inscripciones');

                                    } else {
                                        $scope.errors = data;

                                    }
                                });
                            }else{
                            alert("Elija una Persona")
                        }
                        }else{
                            alert("Elija una Edicion")
                        }
                    }
                }


                $scope.editInscripcion = function(row){
                    $location.path('/inscripciones/edit/'+row.id);
                };

                $scope.updateInscripcion = function(){

                    if ($scope.inscripcionEditForm.$valid) {
                        $scope.inscripcion.saldo=$scope.inscripcion.montoPagar-$scope.inscripcion.montoPagado;
                        crudService.update($scope.inscripcion,'inscripciones').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('Editado correctamente');
                                $location.path('/inscripciones');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteInscripcion= function(row){
                    
                    $scope.inscripcion = row;
                }

                $scope.cancelInscripcion = function(){
                    $scope.inscripcion = {};
                }

                $scope.destroyInscripcion = function(){
                    crudService.destroy($scope.inscripcion,'inscripciones').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.inscripcion = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }

                $scope.edicionSelected=undefined;
                $scope.getService = function(val) {
                  return crudService.recuperarUnDato('buscarEdicion',val).then(function(response){
                    return response.map(function(item){
                      return item;
                    });
                  });
                };


                $scope.addEdicion = function(){
                    if ($scope.edicionSelected.descripcion==undefined) {
                        alert("Seleccione Correctamente una Edicion");
                        $scope.edicionSelected=undefined;
                        $scope.inscripcion.montoCurso="";
                        $scope.inscripcion.descuento=0;
                        $scope.inscripcion.descuentoPorcentaje=$scope.inscripcion.descuentoPorcentaje;
                        $scope.inscripcion.montoPagar="";
                    }else{
                        $scope.inscripcion.montoCurso=$scope.edicionSelected.costoCurso;
                        $scope.inscripcion.edicion_id=$scope.edicionSelected.idedicion;
                            $scope.inscripcion.descuento=($scope.inscripcion.montoCurso*$scope.inscripcion.descuentoPorcentaje)/100;
                            $scope.inscripcion.montoPagar=$scope.inscripcion.montoCurso-$scope.inscripcion.descuento;
                        
                    }
                }

                $scope.selecionarPromocion = function(){
                    if ($scope.inscripcion.promocion_id==undefined) {
                        $scope.inscripcion.descuentoPorcentaje=0;
                        $scope.inscripcion.descuento=0;
                        $scope.inscripcion.montoPagar=$scope.inscripcion.montoCurso;


                    }else{
                        crudService.byId($scope.inscripcion.promocion_id,'promociones').then(function (data) {
                            $scope.promocion = data;
                            $scope.inscripcion.nombrePromocion=data.descripcion;
                            $scope.inscripcion.descuentoPorcentaje=$scope.promocion.porcentajeDescuento;

                            if ($scope.inscripcion.montoCurso!=undefined) {
                                $scope.inscripcion.descuento=($scope.inscripcion.montoCurso*$scope.inscripcion.descuentoPorcentaje)/100;
                                $scope.inscripcion.montoPagar=$scope.inscripcion.montoCurso-$scope.inscripcion.descuento;
                            }
                        });
                    }
                }
                $scope.personaSelected=undefined;
                $scope.getServicePersona = function(val) {
                  return crudService.recuperarUnDato('buscarPersona',val).then(function(response){
                    return response.map(function(item){
                      return item;
                    });
                  });
                };


                $scope.addPersona = function(){
                    if ($scope.personaSelected.nombres==undefined) {
                        alert("Seleccione Correctamente una Edicion");
                        $scope.personaSelected=undefined;
                    }else{
                        $scope.inscripcion.nombres=$scope.personaSelected.nombres;
                        $scope.inscripcion.apellidos=$scope.personaSelected.apellidos;
                        $scope.inscripcion.dni=$scope.personaSelected.dni;
                        $scope.inscripcion.email=$scope.personaSelected.email;
                        $scope.inscripcion.telefono=$scope.personaSelected.telefono;
                        $scope.inscripcion.persona_id=$scope.personaSelected.id;
                    }
                }
            }]);
})();

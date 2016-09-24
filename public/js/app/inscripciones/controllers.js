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
                    });
                    crudService.all('cargarMedioPublicitarios').then(function(data){  
                        $scope.medioPublicitarios = data;
                    });
                }else{
                    crudService.paginate('inscripciones',1).then(function (data) {
                        $scope.inscripciones = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

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
                        $scope.inscripcion.saldo=$scope.inscripcion.montoCurso;
                        $scope.inscripcion.montoPagado=0;
                        $scope.inscripcion.estado=0;
                        if ($scope.inscripcion.edicion_id!=undefined) {
                            if ($scope.inscripcion.persona_id!=undefined) {
                                crudService.create($scope.inscripcion, 'inscripciones').then(function (data) {
                          
                                    if (data['estado'] == true) {
                                        $scope.success = data['nombres'];
                                        alert('grabado correctamente');
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

                    if ($scope.bancoEditForm.$valid) {
                        crudService.update($scope.inscripcion,'inscripciones').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
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
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }

                $scope.edicionSelected=undefined;
                $scope.getService = function(val) {
                    //alert(val);
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
                    }else{
                        $scope.inscripcion.montoCurso=$scope.edicionSelected.costoCurso;
                        $scope.inscripcion.edicion_id=$scope.edicionSelected.idedicion;
                    }
                }
                $scope.personaSelected=undefined;
                $scope.getServicePersona = function(val) {
                    //alert(val);
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

(function(){
    angular.module('ediciones.controllers',[])
        .controller('EdicionController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.ediciones = [];
                $scope.edicion = {};
                $scope.acreditadoras = {};
                $scope.cursos = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.docentesAdd=[];

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('ediciones',$scope.query,$scope.currentPage).then(function (data){
                        $scope.ediciones = data.data;
                    });
                    }else{
                        crudService.paginate('ediciones',$scope.currentPage).then(function (data) {
                            $scope.ediciones = data.data;
                        });
                    }
                };


                var id = $routeParams.id; 

                if(id)
                {
                    crudService.byId(id,'ediciones').then(function (data) {
                        $scope.edicion = data;

                        if($scope.edicion != null) {
                            if ($scope.edicion.fechaRegistro.length > 0) {
                                $scope.edicion.fechaRegistro = new Date($scope.edicion.fechaRegistro);
                            }
                        }
                    });
                }else{
                    crudService.paginate('ediciones',1).then(function (data) {
                        $scope.ediciones = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                    crudService.all('todasAcreditadoras').then(function (data) {
                        
                        $scope.acreditadoras=data;
                    });
                    crudService.all('todasCursos').then(function (data) {
                        $scope.cursos=data;
                    });

                }

                

                $scope.searchCurso= function(){
                if ($scope.query.length > 0) {
                    crudService.search('ediciones',$scope.query,1).then(function (data){
                        $scope.ediciones = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('ediciones',1).then(function (data) {
                        $scope.ediciones = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };



                $scope.createEdicion = function(){
                    //$scope.atribut.estado = 1;
                    



                    if ($scope.edicionCreateForm.$valid) {
                        //if($scope.edicion.fechaRegistro!=null){
                            $log.log($scope.edicion);
                            crudService.create($scope.edicion, 'ediciones').then(function (data) {
                                

                                

                                  

                                if (data['estado'] == true) {
                                    $scope.success = data['nombres'];
                                    alert('Grabado correctamente');
                                    $location.path('/ediciones');

                                } else {
                                    $scope.errors = data;

                                }
                            });
                        //}else{
                            //alert('Selecione Fecha');  
                        //}
                    }
                }
                //-----------------------------------------------
                $scope.haceAlgo = function(){
                    var name = $scope.name;
                    var fileBrochure = $scope.fileBrochure;
                    var fileResolucion = $scope.fileResolucion;
                    var fileProyecto = $scope.fileProyecto;
                    var filePublicidadFace = $scope.filePublicidadFace;
                    var filePublicidadImprimir = $scope.filePublicidadImprimir;
                    
                    //callbackPaso1(fileBrochure);
                    $scope.paso1($scope.fileBrochure);
                    $scope.paso1($scope.fileResolucion);
                    $scope.createEdicion();
                    //sigo... algo aca
                    //callbackPaso2(fileResolucion);

                    //sigo ... y termino
                    //callbackTermino();
                }

                $scope.paso1 = function (quePaso){
                    if (quePaso!=undefined) {
                        crudService.uploadFile('ediciones',quePaso, name).then(function(data)
                        {
                            $scope.edicion.brochure=data.data;
                        })    
                    }else{
                        $scope.edicion.brochure="";
                    }
                }

                $scope.paso2 = function (quePaso){
                    if (quePaso!=undefined) {
                        crudService.uploadFile('ediciones',quePaso, name).then(function(data)
                        {
                            $scope.edicion.resolucion=data.data;
                        })    
                    }else{
                        $scope.edicion.resolucion="";
                    }  
                }

                
                //$scope.haceAlgo($scope.paso1, $scope.paso2, $scope.createEdicion);
                //------------------------------------------
                //-----------------------------------------

                
                

                $scope.editEdicion = function(row){
                    $location.path('/ediciones/edit/'+row.id);
                };

                $scope.updateEdicion = function(){

                    if ($scope.cursoEditForm.$valid) {
                        if($scope.edicion.fechaRegistro!=null){
                            crudService.update($scope.edicion,'ediciones').then(function(data)
                            {
                                if(data['estado'] == true){
                                    $scope.success = data['nombres'];
                                    alert('editado correctamente');
                                    $location.path('/ediciones');
                                }else{
                                    $scope.errors =data;
                                }
                            });
                        }else{
                            alert('Selecione Fecha');  
                        }
                    }
                };

                $scope.deleteEdicion= function(row){
                    
                    $scope.edicion = row;
                }

                $scope.cancelEdicion = function(){
                    $scope.edicion = {};
                }

                $scope.destroyEdicion = function(){
                    crudService.destroy($scope.edicion,'ediciones').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.edicion = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
                
                $scope.name="";
                var name = $scope.name;
                $scope.uploadFile = function()
                { 
                    var fileBrochure = $scope.fileBrochure;
                    if (fileBrochure!=undefined) {
                        crudService.uploadFile('ediciones',fileBrochure, name).then(function(data)
                        {
                            $scope.edicion.brochure=data.data;
                            $scope.fincion2();
                        });
                    }else{
                        $scope.edicion.brochure="";
                        $scope.fincion2();
                    }                       
                }
                $scope.fincion2 = function(){
                    var fileResolucion = $scope.fileResolucion;
                    if (fileResolucion!=undefined) {
                        crudService.uploadFile('ediciones',fileResolucion, name).then(function(data)
                        {
                            $scope.edicion.resolucion=data.data;
                            $scope.fincion3();
                        });
                    }else{
                        $scope.edicion.resolucion="";
                        $scope.fincion3();
                    }
                }
                $scope.fincion3 = function(){
                    var fileProyecto = $scope.fileProyecto;
                    if (fileProyecto!=undefined) {
                        crudService.uploadFile('ediciones',fileProyecto, name).then(function(data)
                        {
                            $scope.edicion.proyecto=data.data;
                            $scope.fincion4();
                        });
                    }else{
                        $scope.edicion.proyecto="";
                        $scope.fincion4();
                    }
                }
                $scope.fincion4 = function(){
                    var filePublicidadFace = $scope.filePublicidadFace;
                    if (filePublicidadFace!=undefined) {
                        crudService.uploadFile('ediciones',filePublicidadFace, name).then(function(data)
                        {
                            $scope.edicion.publicidadFace=data.data;
                            $scope.fincion5();
                        });
                    }else{
                        $scope.edicion.publicidadFace="";
                        $scope.fincion5();
                    }
                }
                $scope.fincion5 = function(){
                    var filePublicidadImprimir = $scope.filePublicidadImprimir;
                    if (filePublicidadImprimir!=undefined) {
                        crudService.uploadFile('ediciones',filePublicidadImprimir, name).then(function(data)
                        {
                            $scope.edicion.publicidadImprimir=data.data;
                            $scope.createEdicion();
                        });
                    }else{
                        $scope.edicion.publicidadImprimir="";
                        $scope.createEdicion();
                    }
                }

                $scope.docenteSelected=undefined;
                $scope.getService = function(val) {
                  return crudService.recuperarUnDato('buscarDocente',val).then(function(response){
                    return response.map(function(item){
                      return item;
                    });
                  });
                };


                $scope.addDocente = function(){
                    if ($scope.docenteSelected.nombres==undefined) {
                        alert("Seleccione Correctamente un Docente");
                        $scope.docenteSelected=undefined;
                    }else{
                        $scope.docenteSelected.docente_id=$scope.docenteSelected.id;
                        $scope.docentesAdd.push($scope.docenteSelected);
                        $scope.docenteSelected=undefined;
                    }
                }
                $scope.destroyDocente = function($index){
                    //alert($index);
                    $scope.docentesAdd.splice($index,1);
                }
                
                
                    
                
            }]);
})();

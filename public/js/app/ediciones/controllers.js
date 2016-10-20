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
                $scope.banderaCargando=false;

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
                        $scope.edicion.costoCurso=Number($scope.edicion.costoCurso);

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
                    });

                    crudService.all('todasAcreditadoras').then(function (data) {
                        
                        $scope.acreditadoras=data;
                    });
                    crudService.all('todasCursos').then(function (data) {
                        $scope.cursos=data;
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
                    if ($scope.edicionCreateForm.$valid) {
                        //if($scope.edicion.fechaRegistro!=null){
                            $scope.edicion.detDocenteEdicion=$scope.docentesAdd;
                            $scope.edicion.estado="Activo";
                            $scope.banderaCargando=true;
                            crudService.create($scope.edicion, 'ediciones').then(function (data) {
                                if (data['estado'] == true) {
                                    $scope.success = data['nombres'];
                                    alert('Grabado correctamente');
                                    $location.path('/ediciones');

                                } else {
                                    $scope.errors = data;

                                }
                            });
                    }
                }
                           
                $scope.editEdicion = function(row){
                    $location.path('/ediciones/edit/'+row.id);
                };
                $scope.inscribirEdicion = function(row){
                    $location.path('/inscribir/'+row.id);
                };

                $scope.updateEdicion = function(){
                    if ($scope.edicionEditForm.$valid) {
                            $scope.banderaCargando=true;
                            crudService.update($scope.edicion,'ediciones').then(function(data)
                            {
                                if(data['estado'] == true){
                                    $scope.success = data['nombres'];
                                    alert('Editado correctamente');
                                    $location.path('/ediciones');
                                }else{
                                    $scope.errors =data;
                                }
                            });
                    }
                };

                $scope.deleteEdicion= function(row){
                    
                    $scope.edicion = row;
                }

                $scope.cancelEdicion = function(){
                    $scope.edicion = {};
                }

                $scope.destroyEdicion = function(){
                    crudService.search('detalleDocenteEdiciones',$scope.edicion.id,1).then(function (data){
                            $scope.docentesAdd=data;
                            if ($scope.docentesAdd.length>0) {
                                for (var i = $scope.docentesAdd.length - 1; i >= 0; i--) {
                                    crudService.destroy($scope.docentesAdd[i],'detalleDocenteEdiciones').then(function(data){});
                                }
                            }
                        crudService.destroy($scope.edicion,'ediciones').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombre'];
                                $scope.edicion = {};
                                $route.reload();

                            }else{
                                $scope.errors = data;
                            }
                        });
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
                            $scope.funcion2();
                        });
                    }else{
                        $scope.edicion.brochure="";
                        $scope.funcion2();
                    }                       
                }
                $scope.funcion2 = function(){
                    var fileResolucion = $scope.fileResolucion;
                    if (fileResolucion!=undefined) {
                        crudService.uploadFile('ediciones',fileResolucion, name).then(function(data)
                        {
                            $scope.edicion.resolucion=data.data;
                            $scope.funcion3();
                        });
                    }else{
                        $scope.edicion.resolucion="";
                        $scope.funcion3();
                    }
                }
                $scope.funcion3 = function(){
                    var fileProyecto = $scope.fileProyecto;
                    if (fileProyecto!=undefined) {
                        crudService.uploadFile('ediciones',fileProyecto, name).then(function(data)
                        {
                            $scope.edicion.proyecto=data.data;
                            $scope.funcion4();
                        });
                    }else{
                        $scope.edicion.proyecto="";
                        $scope.funcion4();
                    }
                }
                $scope.funcion4 = function(){
                    var filePublicidadFace = $scope.filePublicidadFace;
                    if (filePublicidadFace!=undefined) {
                        crudService.uploadFile('ediciones',filePublicidadFace, name).then(function(data)
                        {
                            $scope.edicion.publicidadFace=data.data;
                            $scope.funcion5();
                        });
                    }else{
                        $scope.edicion.publicidadFace="";
                        $scope.funcion5();
                    }
                }
                $scope.funcion5 = function(){
                    var baner = $scope.baner;
                    if (baner!=undefined) {
                        crudService.uploadFile('ediciones',baner, name).then(function(data)
                        {
                            $scope.edicion.baner=data.data;
                            $scope.funcion6();
                        });
                    }else{
                        $scope.edicion.baner="";
                        $scope.funcion6();
                    }
                }
                $scope.funcion6 = function(){
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
                //============================================
                $scope.uploadEditFile = function()
                { 
                    var fileBrochure = $scope.fileBrochure;
                    if (fileBrochure!=undefined) {
                        crudService.uploadFile('ediciones',fileBrochure, name).then(function(data)
                        {
                            $scope.edicion.brochure=data.data;
                            $scope.funcionEdit2();
                        });
                    }else{
                        $scope.funcionEdit2();
                    }                       
                }
                $scope.funcionEdit2 = function(){
                    var fileResolucion = $scope.fileResolucion;
                    if (fileResolucion!=undefined) {
                        crudService.uploadFile('ediciones',fileResolucion, name).then(function(data)
                        {
                            $scope.edicion.resolucion=data.data;
                            $scope.funcionEdit3();
                        });
                    }else{
                        $scope.funcionEdit3();
                    }
                }
                $scope.funcionEdit3 = function(){
                    var fileProyecto = $scope.fileProyecto;
                    if (fileProyecto!=undefined) {
                        crudService.uploadFile('ediciones',fileProyecto, name).then(function(data)
                        {
                            $scope.edicion.proyecto=data.data;
                            $scope.funcionEdit4();
                        });
                    }else{
                        $scope.funcionEdit4();
                    }
                }
                $scope.funcionEdit4 = function(){
                    var filePublicidadFace = $scope.filePublicidadFace;
                    if (filePublicidadFace!=undefined) {
                        crudService.uploadFile('ediciones',filePublicidadFace, name).then(function(data)
                        {
                            $scope.edicion.publicidadFace=data.data;
                            $scope.funcionEdit5();
                        });
                    }else{
                        $scope.funcionEdit5();
                    }
                }
                $scope.funcionEdit5 = function(){
                    var baner = $scope.baner;
                    if (baner!=undefined) {
                        crudService.uploadFile('ediciones',baner, name).then(function(data)
                        {
                            $scope.edicion.baner=data.data;
                            $scope.funcionEdit6();
                        });
                    }else{
                        $scope.funcionEdit6();
                    }
                }
                $scope.funcionEdit6 = function(){
                    var filePublicidadImprimir = $scope.filePublicidadImprimir;
                    if (filePublicidadImprimir!=undefined) {
                        crudService.uploadFile('ediciones',filePublicidadImprimir, name).then(function(data)
                        {
                            $scope.edicion.publicidadImprimir=data.data;
                            $scope.updateEdicion();
                        });
                    }else{
                        $scope.updateEdicion();
                    }
                }
                //============================================
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
                $scope.crearDocenteEdicion = function(){
                    if ($scope.docenteSelected.nombres==undefined) {
                        alert("Seleccione Correctamente un Docente");
                        $scope.docenteSelected=undefined;
                    }else{
                        $scope.docenteSelected.docente_id=$scope.docenteSelected.id;
                        $scope.docenteSelected.edicion_id=id;

                        crudService.create($scope.docenteSelected, 'detalleDocenteEdiciones').then(function (data) {
                            $scope.docenteSelected=undefined;
                            crudService.search('detalleDocenteEdiciones',id,1).then(function (data){
                                $scope.docentesAdd=data;
                            });
                        });
                        
                    }
                }

                $scope.disableProduct = function(row){
                    crudService.byforeingKey('ediciones','disablePersona',row.id).then(function(data)
                    {
                        if(data['estado'] == true){
                            $route.reload();
                        }else{
                            alert('No se pudo cambiar el estado');
                        }
                    });
                }

                $scope.destroyDocente = function($index){
                    $scope.docentesAdd.splice($index,1);
                }
                $scope.eliminarDocenteEdicion = function(docente){
                    crudService.destroy(docente,'detalleDocenteEdiciones').then(function(data)
                    {
                        crudService.search('detalleDocenteEdiciones',id,1).then(function (data){
                             $scope.docentesAdd=data;
                        });
                    });
                }
                
                
                    
                
            }]);
})();

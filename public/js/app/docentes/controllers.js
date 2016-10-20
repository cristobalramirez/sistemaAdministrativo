 (function(){
    angular.module('docentes.controllers',[])
        .controller('DocenteController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.docentes = [];
                $scope.docente = {};
                $scope.docente.pais_id="1";
                $scope.dniEditar;
                //----------------------
                $scope.Departamentos ={};
                $scope.DepertamentoSelect;
                $scope.Provincias ={};
                $scope.ProvinciaSelect;
                $scope.Distritos ={};
                $scope.DistritoSelect;
                //$scope.file="";
                //----------------------
                $scope.profesiones={};
                $scope.errors = null;
                $scope.ubigeo ={};
                $scope.success;
                $scope.query = '';
                $scope.banderaCargando=false;

                $scope.toggle = function () { 
                    $scope.show = !$scope.show; 
                };
                $scope.validarPais = function () { 
                    $scope.DepertamentoSelect=null;
                    $scope.ProvinciaSelect=null;
                    $scope.DistritoSelect=null;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('docentes',$scope.query,$scope.currentPage).then(function (data){
                        $scope.docentes = data.data;
                    });
                    }else{
                        crudService.paginate('docentes',$scope.currentPage).then(function (data) {
                            $scope.docentes = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'docentes').then(function (data) {
                        $scope.docente = data;
                        $scope.docente.dni=Number($scope.docente.dni);
                        $scope.dniEditar=$scope.docente.dni;
                        $scope.docente.telefono=Number($scope.docente.telefono); 
                        if($scope.docente != null) {
                            if ($scope.docente.fechaNac.length > 0) {
                                $scope.docente.fechaNac = new Date($scope.docente.fechaNac);
                            }
                        }

                        crudService.byId($scope.docente.ubigeo_id,'ubigeos').then(function (data) {
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
                    
                    crudService.all('cargarProfesiones').then(function(data){  
                        $scope.profesiones = data;
                    });
                    crudService.all('cargarPaises').then(function(data){  
                        $scope.paises = data;
                    });

                }else{
                    crudService.paginate('docentes',1).then(function (data) {
                        $scope.docentes = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                    //-------------------------------------------------------------
                    
                    crudService.all('ubigeoDepartamento').then(function(data){  
                        $scope.Departamentos = data;
                    });
                    
                    crudService.all('cargarProfesiones').then(function(data){  
                        $scope.profesiones = data;
                    });
                    crudService.all('cargarPaises').then(function(data){  
                        $scope.paises = data;
                    });
                }

                

                $scope.searchDocente = function(){
                if ($scope.query.length > 0) {
                    crudService.search('docentes',$scope.query,1).then(function (data){
                        $scope.docentes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('docentes',1).then(function (data) {
                        $scope.docentes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createDocente = function(){
                            $scope.docente.ubigeo_id=$scope.DistritoSelect;
                            $scope.docente.estado="Activo";
                            $scope.banderaCargando=true;
                            if ($scope.docente.fechaNac==null) {
                               $scope.docente.fechaNac= "0000-00-00 00:00:00"
                            }
                            $log.log($scope.docente);
                                crudService.create($scope.docente, 'docentes').then(function (data) {
                                    
                                    if (data['estado'] == true) {
                                    $scope.success = data['nombres'];
                                        alert('Grabado correctamente');
                                        $location.path('/docentes');

                                    } else {
                                        $scope.errors = data;

                                    }
                                });

                                


                                
                        
                }


                $scope.editDocente = function(row){
                    $location.path('/docentes/edit/'+row.id);
                };

                $scope.updateDocente = function(){

                    
                                $scope.docente.ubigeo_id=$scope.DistritoSelect;
                                $scope.banderaCargando=true;
                                crudService.update($scope.docente,'docentes').then(function(data)
                                {
                                    if(data['estado'] == true){
                                        $scope.success = data['nombres'];
                                        alert('Editado correctamente');
                                        $location.path('/docentes');
                                    }else{
                                        $scope.errors =data;
                                    }
                                });
                        
                };

                $scope.deleteDocente = function(row){
                    
                    $scope.docente = row;
                }

                $scope.cancelDocente = function(){
                    $scope.docente = {};
                }

                $scope.destroyDocente = function(){
                    crudService.destroy($scope.docente,'docentes').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.docente = {};
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
                            crudService.validar('docentes',texto).then(function (data){
                                if(data.dni!=undefined){
                                 alert("DNI Registrado!!");
                                 $scope.docente.dni=undefined;
                                }
                            });   
                        }
                        
                    }
               }
               $scope.disableProduct = function(row){
                    crudService.byforeingKey('docentes','disablePersona',row.id).then(function(data)
                    {
                        if(data['estado'] == true){
                            $route.reload();
                        }else{
                            alert('No se pudo cambiar el estado');
                        }
                    });
                }
                $scope.name="archivo";
                $scope.uploadFile = function()
                {
                    if ($scope.docenteCreateForm.$valid) {
                        
                        var name = $scope.name;
                        var file = $scope.file;

                        if (file!=undefined) {
                            crudService.uploadFile('docentes',file, name).then(function(data)
                            {
                                $scope.docente.curriculo=data.data;
                                $scope.createDocente();
                            })    
                        }else{
                            $scope.docente.curriculo="";
                            $scope.createDocente();
                        }
                                        
                    }
                    
                }
                $scope.editUploadFile = function()
                {
                    if ($scope.DocenteEditForm.$valid) {
                        
                        var name = $scope.name;
                        var file = $scope.file;

                        if (file!=undefined) {
                            crudService.uploadFile('docentes',file, name).then(function(data)
                            {
                                $scope.docente.curriculo=data.data;
                                $scope.updateDocente();
                            })    
                        }else{
                            //$scope.docente.curriculo="";
                            $scope.updateDocente();
                        }
                                        
                    }
                    
                }

            }]);
})();

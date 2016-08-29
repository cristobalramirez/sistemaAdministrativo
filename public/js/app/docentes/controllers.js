 (function(){
    angular.module('docentes.controllers',[])
        .controller('DocenteController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.docentes = [];
                $scope.docente = {};
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
                        //$scope.file="/usr/share/nginx/html/sistemaAdministrativo/public"+$scope.docente.curriculo;
                        //$log.log($scope.file);
                        if($scope.docente != null) {
                            if ($scope.docente.fechaNac.length > 0) {
                                $scope.docente.fechaNac = new Date($scope.docente.fechaNac);
                            }
                            if ($scope.docente.fechaRegistro.length > 0) {
                                $scope.docente.fechaRegistro = new Date($scope.docente.fechaRegistro);
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

                }else{
                    crudService.paginate('docentes',1).then(function (data) {
                        $log.log(data.data);
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
                    //$scope.atribut.estado = 1;
                    $log.log($scope.docente);
                    

                            $scope.docente.ubigeo_id=$scope.DistritoSelect;
                            $scope.docente.estado="Activo";
                            $log.log($scope.docente);
                            $scope.banderaCargando=true;
                                crudService.create($scope.docente, 'docentes').then(function (data) {
                                    
                                    if (data['estado'] == true) {
                                    $scope.success = data['nombres'];
                                        alert('grabado correctamente');
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
                                        alert('editado correctamente');
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
                            //alert('hola');
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
                        $log.log($scope.Distritos);
                    });
                }
                
                $scope.validaDni=function(texto){

                   if(texto!=undefined){

                        crudService.validar('docentes',texto).then(function (data){
                            $log.log(data);
                            if(data.dni!=undefined){
                                alert("DNI Registrado!!");
                                $scope.docente.dni='';
                            }
                        });
                    }
               }
               $scope.disableProduct = function(row){
                    //$log.log(row);
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
                        if($scope.DistritoSelect!=null){
                            if($scope.docente.profesion_id!=null){
                                if($scope.docente.sexo!=null){
                                    if($scope.docente.fechaNac!=null){    
                                        if($scope.docente.fechaRegistro!=null){  
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
                                        }else{
                                            alert('Selecione Fecha de Registro');
                                        }
                                    }else{
                                        alert('Selecione Fecha de Nacimiento');
                                    }
                                }else{
                                    alert('Selecione Sexo');
                                }
                            }else{
                                alert('Selecione Profecion');
                            }
                        }else{
                            alert('Selecione Direcion Correctamente');
                        }
                    }
                    
                }
                $scope.editUploadFile = function()
                {
                    if ($scope.DocenteEditForm.$valid) {
                        if($scope.DistritoSelect!=null){
                            if($scope.docente.profesion_id!=null){
                                if($scope.docente.sexo!=null){
                                    if($scope.docente.fechaNac!=null){    
                                        if($scope.docente.fechaRegistro!=null){  
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
                                        }else{
                                            alert('Selecione Fecha de Registro');
                                        }
                                    }else{
                                        alert('Selecione Fecha de Nacimiento');
                                    }
                                }else{
                                    alert('Selecione Sexo');
                                }
                            }else{
                                alert('Selecione Profecion');
                            }
                        }else{
                            alert('Selecione Direcion Correctamente');
                        }
                    }
                    
                }

            }]);
})();

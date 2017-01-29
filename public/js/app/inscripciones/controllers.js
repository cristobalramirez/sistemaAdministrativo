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
                $scope.cursos={};
                $scope.selectCurso;
                $scope.ediciones={};
                $scope.cuentas={};
                $scope.pago={};
                $scope.recuperarInscripcion = {};
                $scope.file;
                $scope.pagoEliminar;
                $scope.seguimientoInscripcion={};
                $scope.seguimientos={};
                $scope.SeguimientoEliminar = {};
                $scope.banderaPago=false;
                $scope.estadoInscripcion=0;
                //----------------------
                $scope.Departamentos ={};
                $scope.DepertamentoSelect;
                $scope.Provincias ={};
                $scope.ProvinciaSelect;
                $scope.Distritos ={};
                $scope.DistritoSelect; 
                //$scope.file="";
                //----------------------
                $scope.DomicilioDepartamentos ={};
                $scope.DomicilioDepertamentoSelect;
                $scope.DomicilioProvincias ={};
                $scope.DomicilioProvinciaSelect;
                $scope.DomicilioDistritos ={};
                $scope.DomicilioDistritoSelect;
                //----------------------

                $scope.envio={};
                $scope.fechaCompromisoBuscar;

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };
                $scope.buscarFecha = function () {
                    if ($scope.fechaCompromisoBuscar==undefined) {
                        $scope.fechaCompromisoBuscar=0;
                        var fecha=undefined;
                        $scope.fechaBuscar=0;
                    }else{
                        var fecha = new Date($scope.fechaCompromisoBuscar)
                        var dia;
                        if (fecha.getDate()<10) {
                           var dia= "0"+fecha.getDate();
                        }else{
                            var dia=fecha.getDate();
                        }
                        $scope.fechaBuscar=fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+dia;
                    }
                    crudService.recuperarTresDatoPag('buscaredicionCurso',$scope.selectCurso,$scope.selectEdicion,$scope.fechaBuscar,1).then(function (data) {
                            $scope.inscripciones = data.data;
                            $scope.totalItems = data.total;
                            $scope.currentPage = data.current_page;
                        });
                };
                
                $scope.buscarCursos = function () {
                    $scope.fechaCompromisoBuscar=undefined;
                    $scope.selectEdicion=undefined;
                    if ($scope.selectCurso==undefined) {
                        $scope.selectCurso=0;
                        
                    }
                    crudService.recuperarTresDatoPag('buscaredicionCurso',$scope.selectCurso,0,0,1).then(function (data) {
                            $scope.inscripciones = data.data;
                            $scope.totalItems = data.total;
                            $scope.currentPage = data.current_page;

                            crudService.recuperarUnDato('edicionesCurso',$scope.selectCurso).then(function (data) {
                                $scope.ediciones=data;
                            });
                        });
                };
                $scope.buscarEdicion = function () {
                    $scope.fechaCompromisoBuscar=undefined;
                    if ($scope.selectEdicion==undefined) {
                        $scope.selectEdicion=0;
                        
                    }
                    crudService.recuperarTresDatoPag('buscaredicionCurso',$scope.selectCurso,$scope.selectEdicion,0,1).then(function (data) {
                            $scope.inscripciones = data.data;
                            $scope.totalItems = data.total;
                            $scope.currentPage = data.current_page;
                        });
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('inscripciones',$scope.query,$scope.currentPage).then(function (data){
                        $scope.inscripciones = data.data;
                    });
                    }else if ($scope.selectCurso!=undefined) {
                        if ($scope.selectEdicion==undefined) {
                            $scope.selectEdicion=0;
                        }
                        crudService.recuperarTresDatoPag('buscaredicionCurso',$scope.selectCurso,$scope.selectEdicion,$scope.fechaBuscar,$scope.currentPage).then(function (data) {
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
                    crudService.all('todasCursos').then(function (data) {
                        $scope.cursos=data;
                    });

                    crudService.all('todasCuentas').then(function(data){  
                        $scope.cuentas = data;
                    });

                    crudService.all('ubigeoDepartamento').then(function(data){  
                        $scope.Departamentos = data;
                        //01-01-2017
                        $scope.DomicilioDepartamentos = data;
                    });
                     crudService.all('cargarAgencias').then(function(data){  
                        $scope.agencias = data;
                    });
                     crudService.all('cargarProfesiones').then(function(data){  
                        $scope.profesiones = data;
                    });
                }

                $scope.cargarPagos = function(row){
                    $scope.recuperarInscripcion = row;
                    crudService.recuperarUnDato('pagos',row.id).then(function (data){
                        $scope.pagos = data;
                    });
                   
                };
                $scope.cargarseguimientos = function(row){
                    $scope.recuperarInscripcion = row;
                    $scope.estadoInscripcion=$scope.recuperarInscripcion.estado;
                    $scope.seguimientoInscripcion.inscripcion_id=row.id;
                    $scope.seguimientoInscripcion.empleado_id=1;

                    crudService.recuperarUnDato('seguimientos',row.id).then(function (data){
                        $scope.seguimientos = data;
                    });
                };

                $scope.cargarPersona = function(row){
                    $scope.persona={};
                    $scope.persona=row.persona; 
                    $scope.persona.telefono=Number($scope.persona.telefono);
                    $scope.persona.dni=Number($scope.persona.dni);
                    $scope.persona.fechaNac=new Date($scope.persona.fechaNac);
                    console.log($scope.persona);
                    // 01-01-2017

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
                    
                };
                $scope.ActualizarPersona = function(){
                    if ($scope.PersonaEditForm.$valid) {
                            $scope.persona.ubigeoDireccion_id=$scope.DomicilioDistritoSelect;
                            crudService.update($scope.persona,'personas').then(function(data){
                                if(data['estado'] == true){
                                    $scope.success = data['nombres'];
                                    alert('Actualizado correctamente');
                                        if ($scope.selectCurso!=undefined) {
                                            $scope.selectCurso=0;
                                        }
                                        if ($scope.selectEdicion==undefined) {
                                         $scope.selectEdicion=0;
                                        }
                                        if ($scope.fechaBuscar==undefined) {
                                            $scope.fechaBuscar=0;
                                        }
                                        crudService.recuperarTresDatoPag('buscaredicionCurso',$scope.selectCurso,$scope.selectEdicion,$scope.fechaBuscar,$scope.currentPage).then(function (data) {
                                            $scope.inscripciones = data.data;
                                        });  
                                    }else{
                                        $scope.errors =data;
                                    }

                            });                        
                    }
                };
                $scope.SalirPersona = function(){
                    
                    if ($scope.selectCurso!=undefined) {
                        $scope.selectCurso=0;
                    }
                    if ($scope.selectEdicion==undefined) {
                        $scope.selectEdicion=0;
                    }
                    if ($scope.fechaBuscar==undefined) {
                        $scope.fechaBuscar=0;
                    }
                    crudService.recuperarTresDatoPag('buscaredicionCurso',$scope.selectCurso,$scope.selectEdicion,$scope.fechaBuscar,$scope.currentPage).then(function (data) {
                        $scope.inscripciones = data.data;
                    });
                                             
                                    
                };

                

                $scope.GrabarSeguimiento = function(row){
                    $scope.seguimientoInscripcion.estado=$scope.estadoInscripcion;
                    if ($scope.recuperarInscripcion.estado!=$scope.estadoInscripcion) {
                        $scope.recuperarInscripcion.estado=$scope.estadoInscripcion;

                        crudService.update($scope.recuperarInscripcion,'inscripciones').then(function(data)
                        {
                            
                        });
                    }
                    crudService.create($scope.seguimientoInscripcion, 'seguimientoInscripciones').then(function (data) {
                        if (data['estado'] == true) {
                            $scope.success = data['nombres'];
                            crudService.recuperarUnDato('seguimientos',$scope.recuperarInscripcion.id).then(function (data){
                                $scope.seguimientos = data;
                            });
                            $scope.seguimientoInscripcion.fechaCompromiso=null;
                            $scope.seguimientoInscripcion.horaCompromiso=null;
                            $scope.seguimientoInscripcion.descripcion=null;
                            //$scope.estadoInscripcion=0;
                            alert('Registrado correctamente');

                        } else {
                            $scope.errors = data;

                        }
                    });
                };

                $scope.deleteSeguimiento= function(row){
                    
                    $scope.SeguimientoEliminar = row;
                }

                $scope.cancelSeguimiento = function(){ 
                    $scope.SeguimientoEliminar = {};
                }
                $scope.destroySeguimiento = function(){
                    crudService.destroy($scope.SeguimientoEliminar,'seguimientoInscripciones').then(function(data)
                    {
                        crudService.recuperarUnDato('seguimientos',$scope.recuperarInscripcion.id).then(function (data){
                                $scope.seguimientos = data;
                            });
                        if(data['estado'] == true){
                            $scope.SeguimientoEliminar = {};
                        }else{
                            $scope.errors = data;
                        }
                    });
                   
                };

                $scope.name="archivo";
                $scope.uploadFile = function()
                {
                    if ($scope.pagoCreateForm.$valid) {
                        
                        var name = $scope.name;
                        var file = $scope.file;
                        $scope.banderaPago=true;
                        if (file!=undefined) {
                            crudService.uploadFile('vaucherPago',file, name).then(function(data)
                            {
                                $scope.pago.vaucher=data.data;
                                $scope.realizarPago();
                            })    
                        }else{
                            $scope.pago.vaucher="";
                            $scope.realizarPago();
                        }                    
                    }  
                }
                $scope.realizarPago = function(){
                    $scope.seguimiento={};
                    $scope.recuperarInscripcion.montoPagado=Number($scope.recuperarInscripcion.montoPagado)+$scope.pago.monto;
                    $scope.recuperarInscripcion.saldo=Number($scope.recuperarInscripcion.montoPagar)-Number($scope.recuperarInscripcion.montoPagado);
                    if ($scope.recuperarInscripcion.saldo==$scope.recuperarInscripcion.montoPagar) {
                        $scope.recuperarInscripcion.estado=0;   
                    }else if ($scope.recuperarInscripcion.saldo>0) {
                        $scope.recuperarInscripcion.estado=3; 
                    }else{
                      $scope.recuperarInscripcion.estado=1;   
                    }
                    $scope.seguimiento.estado=$scope.recuperarInscripcion.estado;
                    $scope.seguimiento.descripcion='Pago';
                    $scope.seguimiento.empleado_id=1;
                    $scope.seguimiento.inscripcion_id=$scope.recuperarInscripcion.id;
                    
                    $scope.pago.inscripcion_id=$scope.recuperarInscripcion.id;

                    $scope.recuperarInscripcion.pago=$scope.pago;

                    crudService.update($scope.recuperarInscripcion,'realizarPago').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('Pago Registrado');
                                $scope.banderaPago=false;
                                $location.path('/inscripciones');
                                $scope.pago={};
                                $scope.file=undefined;
                                $scope.name=undefined;
                                crudService.recuperarUnDato('pagos',$scope.recuperarInscripcion.id).then(function (data){
                                    $scope.pagos = data;
                                });
                                crudService.create($scope.seguimiento, 'seguimientoInscripciones').then(function (data) {
                                    $scope.seguimiento={};
                                });

                            }else{
                                $scope.errors =data;
                            }
                        });
                   
                };

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
                        //02-01-2017
                        $scope.inscripcion.empleado_id=1;
                        //-----
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
                    $scope.seguimiento={};
                    if ($scope.inscripcion.promocion_id==3) {
                        $scope.inscripcion.estado=5;
                    }else{
                        $scope.inscripcion.estado=0;
                    }
                    $scope.seguimiento.estado=$scope.inscripcion.estado;
                    $scope.seguimiento.descripcion='Promoción';
                    $scope.seguimiento.empleado_id=1;
                    $scope.seguimiento.inscripcion_id=$scope.inscripcion.id;

                    if ($scope.inscripcionEditForm.$valid) {
                        $scope.inscripcion.saldo=$scope.inscripcion.montoPagar-$scope.inscripcion.montoPagado;
                        crudService.update($scope.inscripcion,'inscripciones').then(function(data)
                        {
                            if(data['estado'] == true){
                                crudService.create($scope.seguimiento, 'seguimientoInscripciones').then(function (data) {
                                    $scope.seguimiento={};
                                });
                                $scope.success = data['nombres'];
                                alert('Editado correctamente');
                                $location.path('/inscripciones');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deletePago= function(row){
                    
                    $scope.pagoEliminar = row;
                }

                $scope.cancelPago = function(){
                    $scope.pagoEliminar = {};
                }
                $scope.destroyPago = function(){
                    $scope.recuperarInscripcion.montoPagado=Number($scope.recuperarInscripcion.montoPagado)-$scope.pagoEliminar.monto;
                    $scope.recuperarInscripcion.saldo=Number($scope.recuperarInscripcion.montoPagar)-Number($scope.recuperarInscripcion.montoPagado);
                    if ($scope.recuperarInscripcion.saldo==$scope.recuperarInscripcion.montoPagar) {
                        $scope.recuperarInscripcion.estado=0;   
                    }else if ($scope.recuperarInscripcion.saldo>0) {
                        $scope.recuperarInscripcion.estado=3; 
                    }else{
                      $scope.recuperarInscripcion.estado=1;   
                    }
                    
                    $scope.pagoEliminar.inscripcion_id=$scope.recuperarInscripcion.id;

                    $scope.recuperarInscripcion.pagoEliminar=$scope.pagoEliminar;

                    crudService.destroy($scope.recuperarInscripcion,'eliminarPago').then(function(data)
                    {
                        crudService.recuperarUnDato('pagos',$scope.recuperarInscripcion.id).then(function (data){
                                    $scope.pagos = data;
                                });
                        if(data['estado'] == true){
                            $scope.pagoEliminar = {};
                        }else{
                            $scope.errors = data;
                        }
                    });
                   
                };


                $scope.deleteInscripcion= function(row){
                    
                    $scope.inscripcion = row;
                }

                $scope.cancelInscripcion = function(){
                    $scope.inscripcion = {};
                }
                $scope.destroyInscripcion = function(){
                    console.log($scope.inscripcion);
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
                $scope.GrabarEnvio = function(){
                    $scope.envio.ubigeo_id=$scope.DistritoSelect;
                    $scope.envio.inscripcion_id=$scope.recuperarInscripcion.id;
                    crudService.create($scope.envio, 'envios').then(function (data) {
                        if (data['estado'] == true) {
                            $scope.success = data['nombres'];
                            alert('Envio Registrado correctamente');
                            $scope.traerEnvio($scope.recuperarInscripcion.id); 
                        } else {
                            $scope.errors = data;
                        }
                    });    
                }
                $scope.EditarEnvio = function(){
                    $scope.envio.ubigeo_id=$scope.DistritoSelect;
                    crudService.update($scope.envio,'envios').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombres'];
                            alert('Actualizado correctamente');
                            $scope.traerEnvio($scope.recuperarInscripcion.id); 
                        }else{
                            $scope.errors =data;
                        }
                    });
                    
                };
                $scope.cargarEnvio = function(row){
                    $scope.recuperarInscripcion = row;
                    $scope.traerEnvio($scope.recuperarInscripcion.id);
                   
                };

                $scope.traerEnvio= function(id){
                    crudService.byId(id,'envioInscripcion').then(function (data){
                        $scope.envio = data[0];
                        if ($scope.envio!=undefined) {
                            $scope.envio.monto=Number($scope.envio.monto);
                            if ($scope.envio.fechaCompromiso != null) {
                                $scope.envio.fechaCompromiso = new Date($scope.envio.fechaCompromiso);
                            }
                            if ($scope.envio.fechaEnvio != null) {
                                $scope.envio.fechaEnvio = new Date($scope.envio.fechaEnvio);
                            }
                            crudService.byId($scope.envio.ubigeo_id,'ubigeos').then(function (data) {
                                $scope.ubigeo = data;
                                crudService.all('ubigeoDepartamento').then(function(data){  
                                    $scope.Departamentos = data;
                                    $scope.DepertamentoSelect=$scope.ubigeo.departamento;
                                });
                                crudService.recuperarUnDato('ubigeoProvincia',$scope.ubigeo.departamento).then(function(data){  
                                    $scope.Provincias = data;
                                    $scope.ProvinciaSelect=$scope.ubigeo.provincia;
                                });
                                crudService.recuperarDosDato('ubigeoDistrito',$scope.ubigeo.departamento,$scope.ubigeo.provincia).then(function(data){  
                                    $scope.Distritos = data;
                                    $scope.DistritoSelect=$scope.ubigeo.id;
                                });
                            });
                            $scope.banderaEnvio=true;
                        }else{
                            $scope.banderaEnvio=false;
                            $scope.envio={};
                            $scope.DepertamentoSelect=undefined;
                            $scope.ProvinciaSelect=undefined;
                            $scope.DistritoSelect=undefined;
                            $scope.envio.descripcion=$scope.recuperarInscripcion.nombres+" "+$scope.recuperarInscripcion.apellidos;
                        }
                        
                    });
                }

                //01-01-2017
                $scope.DomicilioCargarProvincia = function(){
                    $scope.DomicilioProvincias ={};
                    $scope.DomicilioProvinciaSelect=null;
                    $scope.DomicilioDistritoSelect=null;
                    crudService.recuperarUnDato('ubigeoProvincia',$scope.DomicilioDepertamentoSelect).then(function(data){  
                        $scope.DomicilioProvincias = data;
                    });
                }
                $scope.DomicilioCargarDistrito = function(){
                    $scope.DomicilioDistritos ={};
                    $scope.DomicilioDistritoSelect=null;
                    crudService.recuperarDosDato('ubigeoDistrito',$scope.DomicilioDepertamentoSelect,$scope.DomicilioProvinciaSelect).then(function(data){  
                        $scope.DomicilioDistritos = data;
                        
                    });
                }


            }]);
})();

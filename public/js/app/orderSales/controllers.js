(function(){
    angular.module('orderSales.controllers',[])
        .controller('OrderSalesController',['$scope', '$routeParams','$location','crudServiceOrderSales','socketService' ,'$filter','$route','$log','$modal',
            function($scope, $routeParams,$location,crudServiceOrderSales,socket,$filter,$route,$log,$modal){
            $scope.inicializar = function (){
                $scope.orderSales = [];
                $scope.orderSale = {};
                $scope.errors = null; 
                $scope.success;
                $scope.query = ''; 
                $scope.store={};
                $scope.warehouse={};
                $scope.warehouse.id='1';
                $scope.store.id='1';
                $scope.cash1={};
                $scope.cash1.cashHeader_id='1';
                $scope.base=true;
                $scope.skuestado=true;
                $scope.compras=[];
                $scope.sale={};
                $scope.banderaNotas=true;

                $scope.sale.montoBruto=0;
                $scope.sale.descuento=0;
                $scope.sale.montoTotal=0;
                $scope.sale.notas="";
                $scope.sale.montoTotalSinDescuento=0;
                $scope.sale.igv=0;

                $scope.pago={};
                $scope.pago.tarjeta=0;
                $scope.pago.cash=0;
                $scope.sale.vuelto=0;

                $scope.bandera=false;
                $scope.banderaPagosCash=true;
                $scope.banderaPagosTarjeta=true;
                $scope.acuenta=false;

                $scope.salePayment={};
                $scope.saledetPayments=[];
                $scope.saledetPayment={};
                $scope.date = new Date();
                $scope.payment={};

                $scope.cantEntregada=0;
                $scope.detOrdersFijo={};
                $scope.entregado=0;
                $scope.banderaMostrarEntrega=false;
                $scope.banderaModificar=false;
                $scope.cancelPedido;

                $scope.sale.customer_id=undefined;
                $scope.sale.employee_id=undefined;
                $scope.atributoSelected=undefined;
                $scope.customersSelected=undefined;
                $scope.employeeSelected=undefined;

                $scope.montoAcuenta=0;
                $scope.montosaldo=0;
                //$scope.calculospedido();
                //$scope.cancelPedido=false;
                $scope.cashfinal={};
            }
            $scope.inicializar();
                
                $scope.estadoMostrarEntrega = function () {
                    if ($scope.order1.estado!=0) {$scope.banderaMostrarEntrega=true;}else{
                        $scope.banderaMostrarEntrega=false;
                    }
                };
                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudServiceOrderSales.search('orderSales',$scope.query,$scope.currentPage).then(function (data){
                        $scope.orderSales = data.data;

                    });
                    }else{
                        crudServiceOrderSales.paginate('orderSales',$scope.currentPage).then(function (data) {
                            $scope.orderSales = data.data;
                        });
                    }

                };


                var id = $routeParams.id;

                if(id)
                {
                    crudServiceOrderSales.byId(id,'orderSales').then(function (data) {
                        $scope.order1 = data;
                        //$log.log($scope.order1);
                        if ($scope.order1.estado==0) {$scope.cancelPedido=false}else if($scope.order1.estado==3){$scope.cancelPedido=true};
                        //alert($scope.order1.estado);
                        $scope.estadoMostrarEntrega();

                       crudServiceOrderSales.search('DetOrderSales',$scope.order1.id,1).then(function (data){
                           $scope.detOrders = data.data;
                           $scope.detOrdersFijo = data.data;
                          //$log.log($scope.detOrders); 
                          //alert("Hola");
                          

                            crudServiceOrderSales.search('salePaymentOrder',$scope.order1.id,1).then(function (data){
                                $scope.payment = data.data;
                                //$log.log($scope.payment);
                                //$log.log($scope.payment);
                                $scope.calculospedido();
                                
                                crudServiceOrderSales.search('SaleDetPayment',$scope.payment[0].id,1).then(function (data){
                                    $scope.detPayments = data.data;
                                    //$log.log(data);
                                });
                            });
                        });

                    });
                    crudServiceOrderSales.select('saleMethodPayments','select').then(function (data) {                        
                        $scope.saleMethodPayments = data;

                    });
                    crudServiceOrderSales.select('stores','select').then(function (data) {                        
                        $scope.stores = data;

                    });
                    crudServiceOrderSales.search('warehousesStore',$scope.store.id,1).then(function (data){
                        $scope.warehouses=data.data;
                    });

                    $scope.atenderOrder=false;
                }else{
                    crudServiceOrderSales.paginate('orderSales',1).then(function (data) {
                        $scope.orderSales = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                        //$log.log($scope.orderSales);
                    });

                    crudServiceOrderSales.select('stores','select').then(function (data) {                        
                        $scope.stores = data;

                    });
                    crudServiceOrderSales.search('warehousesStore',$scope.store.id,1).then(function (data){
                        $scope.warehouses=data.data;
                    });
                    crudServiceOrderSales.search('searchHeaders',$scope.store.id,1).then(function (data){
                        $scope.cashHeaders=data;
                    });

                    crudServiceOrderSales.search('cashes',$scope.cash1.cashHeader_id,1).then(function (data){
                        var canCashes=data.total;
                        var pagActual=Math.ceil(canCashes/15);
                        crudServiceOrderSales.search('cashes',$scope.cash1.cashHeader_id,pagActual).then(function (data){
                            $scope.cashes = data.data;
                            $scope.cashfinal=$scope.cashes[$scope.cashes.length-1];
                            //$log.log($scope.cashfinal);
                            crudServiceOrderSales.search('detCashesSale',$scope.cashfinal.id,1).then(function (data){
                            $scope.detCashes = data.data;
                            $scope.maxSize1 = 5;
                                $scope.totalItems1 = data.total;
                                $scope.currentPage1 = data.current_page;
                                $scope.itemsperPage1 = 15;

                                //$log.log($scope.detCashes);
                            });
                        });
                    });
                }
                $scope.calculospedido =function () {
                    $scope.montoAcuenta=0;
                    $scope.montosaldo=0;
                    for (var i = $scope.detOrders.length - 1; i >= 0; i--) {
                        $scope.montoAcuenta+=(Number($scope.detOrders[i].canEntregado)*Number($scope.detOrders[i].precioVenta))
                    };
                    $scope.montosaldo=Number($scope.payment[0].Acuenta)-$scope.montoAcuenta;
                }

                socket.on('orderSale.update', function (data) {
                    $scope.orderSales=JSON.parse(data);
                });


                $scope.dynamicPopover = {
                    content: 'Hello, World!',
                    templateUrl: 'myPopoverTemplate.html',
                    title: 'Quantity'
                };

                $scope.dynamicPopover1 = {
                    content: 'Hello, World!',
                    templateUrl: 'myPopoverTemplate1.html',
                    title: 'Precio',
                    title1: 'Descuento'
                };

                $scope.dynamicPopover5 = { 
                    content: 'Hello, World!',
                    templateUrl: 'myPopoverTemplate5.html',
                    title: 'Datos'
                };

                $scope.dynamicPopover2 = {
                    content: 'Hello, World!',
                    templateUrl: 'myPopoverTemplate2.html',
                    title: 'Preciodd',
                    title1: 'Descuento'
                };
                $scope.dynamicPopover6 = {
                    content: 'Hello, World!',
                    templateUrl: 'myPopoverTemplate6.html',
                    title: 'Notas',
                };
                //$scope.estadoOrderProduc=1;
                $scope.cancelOrderProduc = function(row,$index) {
                    $scope.detOrders[$index].parteEntregado=0;
                    //ActualizarPartStock();
                    $scope.detOrders[$index].canEntregado=Number($scope.detOrdersFijo[$index].canEntregado)+Number($scope.detOrders[$index].parteEntregado);
                    $scope.detOrders[$index].canPendiente =$scope.detOrdersFijo[$index].cantidad-$scope.detOrders[$index].canEntregado;
                    $log.log(row);
                };
                $scope.atenderOrderEstado = function(row) {
                    
                    //alert($scope.banderaModificar);
                    for (var i = $scope.detOrders.length - 1; i >= 0; i--) {
                            if ($scope.detOrders[i].estado==0) {
                                $scope.detOrders[i].estad=false;
                            }else{
                                $scope.detOrders[i].estad=true;
                            }

                            if ($scope.detOrders[i].estado==1 && $scope.detOrders[i].canPendiente==0){
                                $scope.detOrders[i].estad1=true;
                                //alert("wwwwwwww"+$scope.detOrders[i].cantidad);
                            }else{
                                $scope.detOrders[i].estad1=false; 
                            }
                        }; 
                }
                $scope.ActualizarPartStock= function(row,$index) {
                   //alert($scope.detOrdersFijo[$index].canEntregado);
                   
                   
                   crudServiceOrderSales.byId(id,'orderSales').then(function (data) {
                        $scope.order1 = data;
                       crudServiceOrderSales.search('DetOrderSales',$scope.order1.id,1).then(function (data){
                           $scope.detOrdersFijo = data.data;

                   if (Number($scope.detOrders[$index].parteEntregado)>Number($scope.detOrdersFijo[$index].canPendiente)) {
                        $scope.detOrders[$index].canEntregado=$scope.detOrdersFijo[$index].canEntregado;
                        $scope.detOrders[$index].canPendiente =$scope.detOrdersFijo[$index].canPendiente;
                        $scope.detOrders[$index].parteEntregado=0.00;
                        alert("Excede cantidad");
                   }else{
                        //alert($scope.detOrdersFijo[$index].canEntregado);
                        $scope.detOrders[$index].canEntregado=Number($scope.detOrdersFijo[$index].canEntregado)+Number($scope.detOrders[$index].parteEntregado);
                        $scope.detOrders[$index].canPendiente =$scope.detOrdersFijo[$index].cantidad-$scope.detOrders[$index].canEntregado;
                        if ($scope.detOrders[$index].canPendiente==0) {
                            $scope.detOrders[$index].estado=1;
                        }else{
                            $scope.detOrders[$index].estado=0;
                        }
                   }

                   //$log.log($scope.detOrdersFijo);
                   //$log.log($scope.detOrders);
                    $scope.calculospedido();
                        });
                    });

                }
                $scope.grabarCanPedido= function() {
                    for (var i = $scope.detOrders.length - 1; i >= 0; i--) {
                            //------------------------------------------------
                            if ($scope.detOrders[i].estad==true && $scope.detOrders[i].estado==0 && $scope.detOrders[i].canPendiente!=0) {
                                $scope.detOrders[i].estado=1;
                                //crudServiceOrderSales.update($scope.detOrders[i],'DetOrderSales').then(function (data){
                                //})
                                //$scope.totalParteEntrega=1;
                                $scope.banderaCancel=true;
                                alert("no entrar");
                            }
                            if ($scope.detOrders[i].estad==false && $scope.detOrders[i].estado==1 && $scope.detOrders[i].canPendiente!=0) {
                                $scope.detOrders[i].estado=0;
                                //crudServiceOrderSales.update($scope.detOrders[i],'DetOrderSales').then(function (data){
                                //})
                                $scope.banderaCancel=true;
                                alert("no entrar1");
                            }
                    }
                    $scope.order1.detOrder=$scope.detOrders;
                    $scope.order1.payment=$scope.payment[0];
                    $scope.createsalidaCaja();
                    

                    //crudServiceOrderSales.update($scope.payment[0],'SalePayment').then(function (data){
                    //})

                }
                $scope.createsalidaCaja = function(tipo){
                    crudServiceOrderSales.search('cashes',$scope.cash1.cashHeader_id,1).then(function (data){
                        var canCashes=data.total;
                        var pagActual=Math.ceil(canCashes/15);
                        crudServiceOrderSales.search('cashes',$scope.cash1.cashHeader_id,pagActual).then(function (data){
                            $scope.cashes = data.data;
                            $scope.cashfinal=$scope.cashes[$scope.cashes.length-1];

                        $scope.detCash={};
                        $scope.mostrarAlmacenCaja();

                        $scope.detCash.cash_id=$scope.cashfinal.id; 
                        $scope.detCash.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate();
                        $scope.detCash.hora=$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                        $scope.detCash.montoCaja=$scope.cashfinal.montoBruto;
                    
                        //$scope.detCash.montoMovimientoTarjeta=Number($scope.pago.tarjeta);
                        $scope.detCash.montoMovimientoEfectivo=Number($scope.montosaldo);
                        $scope.detCash.montoFinal=Number($scope.detCash.montoCaja)-$scope.detCash.montoMovimientoEfectivo;
                        $scope.detCash.estado='1'; 
                        //alert(tipo);
                        $scope.detCash.cashMotive_id='18';
                    

                        $scope.cashfinal.gastos=Number($scope.cashfinal.gastos)+Number($scope.detCash.montoMovimientoEfectivo); 
                        $scope.cashfinal.montoBruto=$scope.detCash.montoFinal;
                        //////////////////////////////////////////////
                        $scope.order1.movimiento=$scope.detCash;
                        $scope.order1.caja=$scope.cashfinal;
                        $log.log($scope.order1);
                        crudServiceOrderSales.update($scope.order1,'orderSales').then(function (data){
                        });

                    });
                    });

                    //$scope.sale.fechaPedido=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                    //for (var i = $scope.compras.length - 1; i >= 0; i--) {
                      //  $scope.compras[i].canPendiente=$scope.compras[i].cantidad;
                    //};
                    //$scope.sale.detOrders=$scope.compras;
                    //$scope.sale.movimiento=$scope.detCash; 
                    //$scope.sale.caja=$scope.cashfinal;
                }
                $scope.canPedido= function() {
                    //crudServiceOrderSales.search('salePaymentOrder',$scope.order1.id,1).then(function (data){
                    //$scope.payment = data.data;

                    $scope.banderaModificar=!$scope.banderaModificar;
                    if ($scope.cancelPedido) {
                        if ($scope.montosaldo>0) {
                            $scope.banderaDevolucion=true
                            $scope.payment[0].Acuenta=$scope.payment[0].Acuenta-$scope.montosaldo;
                            $scope.payment[0].Saldo=$scope.payment[0].MontoTotal-$scope.payment[0].Acuenta;
                            //alert($scope.payment[0].Acuenta);
                        }else{$scope.banderaDevolucion=false}
                        $scope.order1.estado=3;
                        for (var i = $scope.detOrders.length - 1; i >= 0; i--) {
                            //$scope.detOrders[i].estad=true;
                            if ($scope.detOrders[i].canPendiente>0) {
                                $scope.detOrders[i].estad=true;
                            }

                            if ($scope.detOrders[i].estado==1 && $scope.detOrders[i].canPendiente==0){
                                $scope.detOrders[i].estad1=true;
                            }else{
                                $scope.detOrders[i].estad1=false; 
                            }
                        }; 
                    }else{
                        $scope.order1.estado=1;
                        for (var i = $scope.detOrders.length - 1; i >= 0; i--) {
                            if ($scope.detOrders[i].canPendiente>0){
                                $scope.detOrders[i].estad=false;
                            }

                            if ($scope.detOrders[i].estado==1 && $scope.detOrders[i].canPendiente==0){
                                $scope.detOrders[i].estad1=true;
                            }else{
                                $scope.detOrders[i].estad1=false; 
                            }   
                        }
                    };
                //});
                    //$log.log($scope.detOrders);

                }
                $scope.crearCompra = function() {
                    $scope.banderaEstadoOrderSale=true;
                    $scope.banderaStokPedidos=true;
                    $scope.banderaCancel=false;
                    $scope.montoPagoCompra=0;
                    $scope.totalParteEntrega=0;
                    $scope.createCompra={};
                    $scope.order1.orderSale_id=id;
                    
                    
                    
                    $scope.createCompra=$scope.order1;

                        for (var i = $scope.detOrders.length - 1; i >= 0; i--) {
                            //------------------------------------------------
                            if ($scope.detOrders[i].estad==true && $scope.detOrders[i].estado==0 && $scope.detOrders[i].canPendiente!=0) {
                                $scope.detOrders[i].estado=1;
                                crudServiceOrderSales.update($scope.detOrders[i],'DetOrderSales').then(function (data){
                                })
                                //$scope.totalParteEntrega=1;
                                $scope.banderaCancel=true;
                                //alert("no entrar");
                            }
                            if ($scope.detOrders[i].estad==false && $scope.detOrders[i].estado==1 && $scope.detOrders[i].canPendiente!=0) {
                                $scope.detOrders[i].estado=0;
                                crudServiceOrderSales.update($scope.detOrders[i],'DetOrderSales').then(function (data){
                                })
                                $scope.banderaCancel=true;
                                //alert("no entrar1"); 
                            }

                            //------------------------------------------------
                            
                            $scope.detOrders[i].idAlmacen=$scope.warehouse.id;
                            $scope.montoPagoCompra=$scope.montoPagoCompra+($scope.detOrders[i].precioVenta*$scope.detOrders[i].canEntregado);
                            $scope.totalParteEntrega+=Number($scope.detOrders[i].parteEntregado);
                            if ($scope.detOrders[i].estado==0) {$scope.banderaEstadoOrderSale=false;};
                            if (($scope.detOrders[i].stock-$scope.detOrders[i].separados)<$scope.detOrders[i].parteEntregado) {
                                $scope.banderaStokPedidos=false;
                            };
                            
                        }; 
                        //alert($scope.banderaStokPedidos);

                        if ($scope.banderaEstadoOrderSale) {
                            $scope.order1.estado=0;   
                        };
                        //$log.log($scope.order1.estado);
                        if ($scope.banderaStokPedidos==false) {
                            alert("STOCK INSUFICIENTE");
                        }else{
                            if ($scope.montoPagoCompra>$scope.payment[0].Acuenta) {
                                alert("PAGO INSUFICIENTE");
                            }else if($scope.totalParteEntrega==0){
                                if ($scope.banderaCancel) {
                                    crudServiceOrderSales.byId(id,'orderSales').then(function (data) {
                                            $scope.order1 = data;
                                            $scope.estadoMostrarEntrega();
                                            crudServiceOrderSales.search('DetOrderSales',$scope.order1.id,1).then(function (data){
                                                $scope.detOrders = data.data;
                                            });
                                        });
                                        $scope.atenderOrder=false;
                                }else{
                                    alert("Ingrese cantidad entrega");
                                }
                            }else{
                                $scope.createCompra.detOrders=$scope.detOrders;
                                //$scope.createCompra.payment=$scope.payment;
                                //$log.log($scope.createCompra);
                                //$log.log($scope.createCompra);
                                $scope.createCompra.fechaPedido=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                                
                                crudServiceOrderSales.create($scope.createCompra, 'ordsales').then(function (data) {
                                       
                                    if (data['estado'] == true) {
                                        //$scope.success = data['nombres'];
                                    alert('grabado correctamente');  
                                        crudServiceOrderSales.byId(id,'orderSales').then(function (data) {
                                            $scope.order1 = data;
                                            $scope.estadoMostrarEntrega();
                                            crudServiceOrderSales.search('DetOrderSales',$scope.order1.id,1).then(function (data){
                                                $scope.detOrders = data.data;
                                                $scope.detOrdersFijo = data.data;
                                            });
                                        });
                                        $scope.atenderOrder=false;                  
                                    } else {
                                        $scope.errors = data;
                                    }
                                });
                            }
                        }
                }
                $scope.atributoSelected=undefined;
                $scope.getAtributos = function(val) {
                  return crudServiceOrderSales.reportProWare('products',$scope.store.id,$scope.warehouse.id,val).then(function(response){
                    return response.map(function(item){
                      return item;
                    });
                  });
                };

                $scope.varianteSkuSelected;
                $scope.varianteSkuSelected1=undefined;
                $scope.getvariantSKU = function(size) {
                    if($scope.varianteSkuSelected.length <10){
                    }else if($scope.varianteSkuSelected.length==10){
                        crudServiceOrderSales.reportProWare('productsSearchsku',$scope.store.id,$scope.warehouse.id,$scope.varianteSkuSelected).then(function(data){    
                            $scope.varianteSkuSelected1={};
                            $scope.varianteSkuSelected1=data;

                            //if ($scope.varianteSkuSelected1[0].Stock>0) { 
                                $scope.Jalar(size);
                            //}else{
                              //  alert("STOCK INSUFICIENTE");
                                //$scope.varianteSkuSelected=undefined;
                            //}                                                          
                        });
                    }
                };
                $scope.Jalar = function(size) {
                    if ($scope.varianteSkuSelected1.length>0) {
                        crudServiceOrderSales.reportProWare('productsVariantes',$scope.store.id,$scope.warehouse.id,$scope.varianteSkuSelected1[0].vari).then(function(data){    
                            $scope.presentations = data;
                            if($scope.base){                
                                    $scope.varianteSkuSelected1[0].cantidad=1;
                                    $scope.varianteSkuSelected1[0].descuento=0;
                                    $scope.varianteSkuSelected1[0].subTotal=$scope.varianteSkuSelected1[0].cantidad*Number($scope.varianteSkuSelected1[0].precioProducto);
                                    $scope.varianteSkuSelected1[0].precioVenta=Number($scope.varianteSkuSelected1[0].precioProducto);
                        
                                   $scope.compras.push($scope.varianteSkuSelected1[0]);  
    
                                    $scope.sale.montoTotal=$scope.sale.montoTotalSinDescuento+$scope.varianteSkuSelected1[0].subTotal;
                                    $scope.recalcularCompra();

                               $scope.varianteSkuSelected1=undefined;
                                $scope.varianteSkuSelected="";
    
                            }else{                           
                                var modalInstance = $modal.open({      
                                    templateUrl: 'myModalContent.html',
                                    controller: 'ModalInstanceCtrl',
                                    size: size,
                                    resolve: {
                                        presentations: function () {
                                          return $scope.presentations;
                                        }                                    
                                    }
                                })
                                $scope.varianteSkuSelected1=undefined;
                                $scope.varianteSkuSelected="";
                            }
                        });
                    }else{
                        alert("Ingrese SKU Correctamente");
                        $scope.varianteSkuSelected1=undefined;
                        $scope.varianteSkuSelected="";
                    } 
                }

                $scope.recalcularCompra=function(){
                    $scope.sale.montoTotalSinDescuento=$scope.sale.montoTotal;
                    $scope.sale.montoTotal=((100-Number($scope.sale.descuento))*Number($scope.sale.montoTotalSinDescuento))/100;    

                    $scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                    $scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;  
                };

                //------------------------------------
                $scope.calcularmontos=function(index){
                    //if($scope.compras[index].cantidad>$scope.compras[index].Stock){
                        //$scope.compras[index].cantidad=Number($scope.compras[index].Stock);
                        //alert("Cantidad excede el STOCK");
                    //}
                    if($scope.compras[index].cantidad<1){
                       $scope.compras[index].cantidad=1;
                       alert("La cantidad debe ser mayor 0"); 
                    }
                    $scope.sale.montoTotal=$scope.sale.montoTotalSinDescuento-$scope.compras[index].subTotal;

                    if($scope.bandera){
                        $scope.compras[index].precioVenta=((100-Number($scope.compras[index].descuento))*Number($scope.compras[index].precioProducto))/100;
                    }else{
                        $scope.compras[index].descuento=((Number($scope.compras[index].precioProducto)-Number($scope.compras[index].precioVenta))*100)/Number($scope.compras[index].precioProducto);
                    }
                    $scope.compras[index].subTotal=$scope.compras[index].cantidad*Number($scope.compras[index].precioVenta);

                    $scope.sale.montoTotal=$scope.sale.montoTotal+$scope.compras[index].subTotal;
                    $scope.recalcularCompra();
                    
                    $scope.bandera=false;   
                };

                $scope.aumentarCantidad= function(index){
                    if ($scope.compras[index].equivalencia!=undefined) {
                        $scope.compras[index].cantidad=$scope.compras[index].cantidad+1;
                        //if($scope.compras[index].cantidad*$scope.compras[index].equivalencia>$scope.compras[index].Stock){
                          //  alert("STOK INSUFICIENTE");
                            //$scope.compras[index].cantidad=$scope.compras[index].cantidad-1;
                        //}else{
                            $scope.calcularmontos(index);    
                        //}
                    }else{
                        $scope.compras[index].cantidad=$scope.compras[index].cantidad+1;
                        $scope.calcularmontos(index);  
                    }
                                
                };
                $scope.disminuirCantidad= function(index){
                    $scope.compras[index].cantidad=$scope.compras[index].cantidad-1;
                    
                    $scope.calcularmontos(index);
                };
                $scope.aumentarPrecio= function(index){
                    $scope.compras[index].precioVenta=Number($scope.compras[index].precioVenta)+1;
                    $scope.calcularmontos(index);
                };
                $scope.disminuirPrecio= function(index){
                    $scope.compras[index].precioVenta=Number($scope.compras[index].precioVenta)-1;
                    $scope.calcularmontos(index);
                };
                $scope.aumentarDescuento= function(index){
                    $scope.compras[index].descuento=Number($scope.compras[index].descuento)+1;
                    $scope.bandera=true;
                    $scope.calcularmontos(index);
                };
                $scope.disminuirDescuento= function(index){
                    $scope.compras[index].descuento=Number($scope.compras[index].descuento)-1;
                    $scope.bandera=true;
                    $scope.calcularmontos(index);
                };
                $scope.keyUpDescuento= function(index){
                    $scope.bandera=true;
                    $scope.calcularmontos(index);
                };
 
                $scope.aumentarTotalPedido= function(){
                    $scope.sale.montoTotal=Number($scope.sale.montoTotal)+1;
                    $scope.sale.descuento=((Number($scope.sale.montoTotalSinDescuento)-Number($scope.sale.montoTotal))*100)/Number($scope.sale.montoTotalSinDescuento);
                    $scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                    $scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                };
               
                $scope.disminuirTotalPedido= function(){
                    $scope.sale.montoTotal=Number($scope.sale.montoTotal)-1;                     
                    $scope.sale.descuento=((Number($scope.sale.montoTotalSinDescuento)-Number($scope.sale.montoTotal))*100)/Number($scope.sale.montoTotalSinDescuento);    
                    $scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                    $scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                };
                 $scope.keyUpTotalPedido= function(){
                    $scope.sale.descuento=((Number($scope.sale.montoTotalSinDescuento)-Number($scope.sale.montoTotal))*100)/Number($scope.sale.montoTotalSinDescuento);
                    $scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                    $scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                };
                $scope.keyUpDescuentoPedido= function(){
                    $scope.sale.montoTotal=((100-Number($scope.sale.descuento))*Number($scope.sale.montoTotalSinDescuento))/100;
                    $scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                    $scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                };
                $scope.aumentarDescuentoPedido= function(){
                    $scope.sale.descuento=Number($scope.sale.descuento)+1;
                    $scope.sale.montoTotal=((100-Number($scope.sale.descuento))*Number($scope.sale.montoTotalSinDescuento))/100;
                    $scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                    $scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                };
                $scope.disminuirDescuentoPedido= function(){
                    $scope.sale.descuento=Number($scope.sale.descuento)-1;
                    $scope.sale.montoTotal=((100-Number($scope.sale.descuento))*Number($scope.sale.montoTotalSinDescuento))/100;    
                    $scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                    $scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                };
                
                $scope.sacarRow=function(index,total){
                    $scope.sale.montoTotal=$scope.sale.montoTotalSinDescuento-$scope.compras[index].subTotal;   
                    $scope.recalcularCompra();
                    $scope.compras.splice(index,1);
                    if($scope.compras.length<1){
                        $scope.sale.descuento=0;    
                    }
                }
                //-----------------------------------------------------
                $scope.estadoNotas = function () {
                    if($scope.sale.notas==""){
                        $scope.banderaNotas=true;
                    }else{
                        $scope.banderaNotas=false;     
                    }
                }
                $scope.open = function (size) {                   
                    $scope.cargarAtri(size);                   
                };

                $scope.cargarAtri = function(size){
                    crudServiceOrderSales.reportProWare('productsVariantes',$scope.store.id,$scope.warehouse.id,$scope.atributoSelected.vari).then(function(data){    
                        $scope.presentations = data;
                        if($scope.base){
                            if ($scope.atributoSelected.NombreAtributos!=undefined) {
                                //if ($scope.atributoSelected.Stock>0) {       
                                    $scope.atributoSelected.cantidad=1;
                                    $scope.atributoSelected.descuento=0;
                                    $scope.atributoSelected.subTotal=$scope.atributoSelected.cantidad*Number($scope.atributoSelected.precioProducto);
                                    $scope.atributoSelected.precioVenta=Number($scope.atributoSelected.precioProducto);
                    
                                    $scope.compras.push($scope.atributoSelected);  

                                    $scope.sale.montoTotal=$scope.sale.montoTotalSinDescuento+$scope.atributoSelected.subTotal;
                                    $scope.recalcularCompra();
                                //}else{
                                  //  alert("STOK INSUFICIENTE");
                                //}   
                            }else{
                                alert("Seleccione Producto Correctamente");
                                $scope.atributoSelected=undefined;
                            }
                            $scope.atributoSelected=undefined;

                        }else{                           
                            var modalInstance = $modal.open({      
                                templateUrl: 'myModalContent.html',
                                controller: 'ModalInstanceCtrl',
                                size: size,
                                resolve: {
                                    presentations: function () {
                                      return $scope.presentations;
                                    }                                    
                                }
                            })
                        }
                    });
                    
                }
                //----------------------Buscador Cliente Vendedor---------------------
                $scope.customersSelected=undefined;
                $scope.getcustomers = function(val) {
                  return crudServiceOrderSales.search('customersVenta',val,1).then(function(response){
                    return response.data.map(function(item){
                      $scope.sale.customer_id=item.id;
                      $scope.sale.cliente=item.busqueda;
                      return item;
                    });
                  });
                };
                $scope.deleteCliente= function(){
                    $scope.sale.customer_id=undefined;
                    $scope.sale.cliente=undefined;
                    $scope.customersSelected=undefined;    
                }

                $scope.employeeSelected=undefined;
                $scope.getemployee = function(val) {
                  return crudServiceOrderSales.search('employeesVenta',val,1).then(function(response){
                    return response.data.map(function(item){
                      $scope.sale.employee_id=item.id;
                      $scope.sale.vendedor=item.busqueda;
                      return item;
                    });
                  });
                };
                $scope.deleteVendedor= function(){
                    $scope.sale.employee_id=undefined;
                    $scope.sale.vendedor=undefined;
                    $scope.employeeSelected=undefined;    
                }

                //---------------create cliente ------------
                $scope.createCustomer = function(){

                    if ($scope.customerCreateForm.$valid) {
                        crudServiceOrderSales.create($scope.customer, 'customers').then(function (data) {
                           
                            if (data['estado'] == true) {
                                $scope.exitCustumer=true;
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                //$location.path('/customers');
                                $('#miventana2').modal('hide');

                            } else {
                                $scope.errors = data.responseJSON;

                            }
                        });
                    }
                    $scope.customer={};
                }
                $scope.pagar = function () {
                    if ($scope.sale.montoTotal==0) {
                        alert("Seleccione productos");
                    }
                }
                //--------------Calcular Vuelto-------------
                $scope.calcularVuelto = function () {
                    if ($scope.pago.tarjeta+$scope.pago.cash>$scope.sale.montoTotal) {
                        $scope.sale.vuelto=(Number($scope.pago.tarjeta)+Number($scope.pago.cash)-Number($scope.sale.montoTotal));
                    }else{
                         $scope.sale.vuelto=0;   
                    };
                    if($scope.pago.cash==undefined){
                        $scope.pago.cash=0;
                    }
                    if($scope.pago.tarjeta==undefined){
                        $scope.pago.tarjeta=0;
                    }
                }
                //------------------Boton Cobrar------------------
                $scope.realizarPago = function () {   
                if ($scope.cashfinal.estado=='1') {
                    $scope.salePayment.MontoTotal=$scope.sale.montoTotal;
                    $scope.salePayment.Acuenta=0;
                    $scope.salePayment.customer_id=$scope.sale.customer_id;

                    if($scope.pago.tarjeta>0 || $scope.pago.cash>0){
                        if($scope.acuenta){
                            //Inicia Pago Credito 
                            alert("Credito");
                            if($scope.customersSelected==undefined){
                                alert("Elija Cliente");
                            }else{
                                $scope.salePayment.estado=1;
                                $scope.sale.estado=1;
                                if ($scope.pago.tarjeta+$scope.pago.cash>$scope.sale.montoTotal){
                                    alert("Usa Pago Contado");
                                }else{
                                    if ($scope.radioModel!=undefined && $scope.pago.tarjeta==0) {
                                        alert("Elija monto Pago Tarjeta");
                                    }else if($scope.radioModel!=undefined && $scope.pago.tarjeta>0){
                                    $scope.salePayment.Acuenta=$scope.salePayment.Acuenta+$scope.pago.tarjeta;
                                    $scope.saledetPayment.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                                    $scope.saledetPayment.monto=$scope.pago.tarjeta;
                                    $scope.saledetPayment.saleMethodPayment_id=$scope.radioModel;
                                    $scope.salePayment.Saldo=$scope.salePayment.MontoTotal-$scope.salePayment.Acuenta;
                                    $scope.saledetPayments.push($scope.saledetPayment);                                 
                                    $scope.saledetPayment={};
                                    }
                                    else if($scope.radioModel==undefined && $scope.pago.tarjeta>0){
                                    alert("Elija Tarjeta.");
                                    $scope.banderaPagosTarjeta=false;
                                    }
    
                                    if($scope.pago.cash>0&&$scope.banderaPagosTarjeta){
                                    $scope.salePayment.Acuenta=$scope.salePayment.Acuenta+$scope.pago.cash;
                                    $scope.saledetPayment.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                                    $scope.saledetPayment.monto=$scope.pago.cash;
                                    $scope.saledetPayment.saleMethodPayment_id='1';

                                    $scope.salePayment.Saldo=$scope.salePayment.MontoTotal-$scope.salePayment.Acuenta;

                                    $scope.saledetPayments.push($scope.saledetPayment);                                
                                    $scope.saledetPayment={};   
                                    }

                                    if ($scope.banderaPagosCash&&$scope.banderaPagosTarjeta) {
                                    $scope.sale.saledetPayments=$scope.saledetPayments;
                                    $scope.sale.salePayment=$scope.salePayment;
                                    var tipo='credito';
                                    $scope.createorder(tipo);
                                    };
                                }
                                $scope.banderaPagosTarjeta=true;
                            }
                           //Termina Pago Credito  
                        }else{
                            //Inicio Pago Contado 
                            alert("Contado");
                            if($scope.customersSelected==undefined){
                                alert("Elija Cliente");
                            }else{
                            if ($scope.pago.tarjeta+$scope.pago.cash>$scope.sale.montoTotal) {
                                //alert("Vuelto : "+(Number($scope.pago.tarjeta)+Number($scope.pago.cash)-Number($scope.sale.montoTotal)));
                                $scope.pago.cash=$scope.pago.cash-(Number($scope.pago.tarjeta)+Number($scope.pago.cash)-Number($scope.sale.montoTotal));
                            };
                            if ($scope.pago.tarjeta+$scope.pago.cash<$scope.sale.montoTotal) {
                                alert("Pago menor a la compra");
                            }else{
                                $scope.salePayment.estado=0;
                                $scope.sale.estado=1;
                                if ($scope.radioModel!=undefined && $scope.pago.tarjeta==0) {
                                    alert("Elija monto Pago Tarjeta");
                                }else if($scope.radioModel!=undefined && $scope.pago.tarjeta>0){
                                    $scope.salePayment.Acuenta=$scope.salePayment.Acuenta+$scope.pago.tarjeta;
                                    $scope.saledetPayment.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                                    $scope.saledetPayment.monto=$scope.pago.tarjeta;
                                    $scope.saledetPayment.saleMethodPayment_id=$scope.radioModel;
                                    $scope.salePayment.Saldo=$scope.salePayment.MontoTotal-$scope.salePayment.Acuenta;
                                    $scope.saledetPayments.push($scope.saledetPayment);                                  
                                    $scope.saledetPayment={};
                                }
                                else if($scope.radioModel==undefined && $scope.pago.tarjeta>0){
                                    alert("Elija Tarjeta");
                                    $scope.banderaPagosTarjeta=false;
                                }
                                if($scope.pago.cash>0 && $scope.banderaPagosTarjeta){
                                    $scope.salePayment.Acuenta=$scope.salePayment.Acuenta+$scope.pago.cash;
                                    $scope.saledetPayment.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                                    $scope.saledetPayment.monto=$scope.pago.cash;
                                    $scope.saledetPayment.saleMethodPayment_id='1';
                                    $scope.salePayment.Saldo=$scope.salePayment.MontoTotal-$scope.salePayment.Acuenta;
                                    $scope.saledetPayments.push($scope.saledetPayment);                                
                                    $scope.saledetPayment={};   
                                }
                                if ($scope.banderaPagosCash&&$scope.banderaPagosTarjeta) {
                                    $scope.sale.saledetPayments=$scope.saledetPayments;
                                    $scope.sale.salePayment=$scope.salePayment;
                                    //crear compra
                                    var tipo='contado';
                                    $scope.createorder(tipo);
                                    //$log.log($scope.sale);
                                };
                                $scope.banderaPagosTarjeta=true;
                                }
                            }
                            }
                        
                        }else{
                            alert("No puede realizar pago");
                        }
                    //--
                    }else{
                        alert("Caja Cerrada");
                        //$scope.createcash();
                    }

                }

                $scope. createorder = function(tipo){
                    crudServiceOrderSales.search('cashes',$scope.cash1.cashHeader_id,1).then(function (data){
                        var canCashes=data.total;
                        var pagActual=Math.ceil(canCashes/15);
                        crudServiceOrderSales.search('cashes',$scope.cash1.cashHeader_id,pagActual).then(function (data){

                            $scope.cashes = data.data;
                            $scope.cashfinal=$scope.cashes[$scope.cashes.length-1];

                            $scope.createmovCaja(tipo);
                            for (var i = 0; i < $scope.sale.saledetPayments.length; i++) {
                                $scope.sale.saledetPayments[i].numCaja=$scope.detCash.cash_id;
                            };
                            $log.log($scope.sale); 
                             crudServiceOrderSales.create($scope.sale, 'orderSales').then(function (data) {
                           
                                    if (data['estado'] == true) {
                                        $scope.success = data['nombres'];
                                    alert('grabado correctamente');
                                    $('#miventana1').modal('hide');
                                        //crudServiceOrders.reportProWare('productsFavoritos',$scope.store.id,$scope.warehouse.id,'1').then(function(data){    
                                            //$scope.favoritos=data;
                                            //$log.log($scope.favoritos);
                                        //});                        
                                    } else {
                                        $scope.errors = data;
                                    }
                            });

                            $scope.inicializar();
                        })    
                    });
                }
                
                $scope.createmovCaja = function(tipo){
                    $scope.detCash={};
                    $scope.mostrarAlmacenCaja();

                    $scope.detCash.cash_id=$scope.cashfinal.id; 
                    $scope.detCash.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate();
                    $scope.detCash.hora=$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                    $scope.detCash.montoCaja=$scope.cashfinal.montoBruto;
                    
                    $scope.detCash.montoMovimientoTarjeta=Number($scope.pago.tarjeta);
                    $scope.detCash.montoMovimientoEfectivo=Number($scope.pago.cash);
                    $scope.detCash.montoFinal=Number($scope.detCash.montoCaja)+$scope.detCash.montoMovimientoTarjeta+$scope.detCash.montoMovimientoEfectivo;
                    $scope.detCash.estado='1'; 
                    //alert(tipo);
                    if(tipo=='credito'){
                        $scope.detCash.cashMotive_id='16';    
                    }else if(tipo=='contado'){
                        $scope.detCash.cashMotive_id='15';   
                    }
                    

                    $scope.cashfinal.ingresos=Number($scope.cashfinal.ingresos)+Number($scope.detCash.montoMovimientoTarjeta)+Number($scope.detCash.montoMovimientoEfectivo); 
                    $scope.cashfinal.montoBruto=$scope.detCash.montoFinal;
                    //////////////////////////////////////////////

                    $scope.sale.fechaPedido=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                    for (var i = $scope.compras.length - 1; i >= 0; i--) {
                        $scope.compras[i].canPendiente=$scope.compras[i].cantidad;
                    };
                    $scope.sale.detOrders=$scope.compras;
                    $scope.sale.movimiento=$scope.detCash; 
                    $scope.sale.caja=$scope.cashfinal;
                }

                $scope.mostrarAlmacenCaja = function () {
                    crudServiceOrderSales.search('searchHeaders',$scope.store.id,1).then(function (data){
                        $scope.cashHeaders=data;
                    });
                    crudServiceOrderSales.search('warehousesStore',$scope.store.id,1).then(function (data){
                        $scope.warehouses=data.data;
                    });
                    crudServiceOrderSales.search('cashes',$scope.cash1.cashHeader_id,1).then(function (data){
                        var canCashes=data.total;
                        var pagActual=Math.ceil(canCashes/15);
                        crudServiceOrderSales.search('cashes',$scope.cash1.cashHeader_id,pagActual).then(function (data){
                            $scope.cashes = data.data;
                            $scope.cashfinal=$scope.cashes[$scope.cashes.length-1];
                        });
                    });    
                }

                $scope.editorder = function(row){
                    $location.path('/orderSales/edit/'+row.id);
                };
                $scope.pagoCredito={};
                $scope.detPago={};
                $scope.createdetPayment = function(){
                    if($scope.detPago.monto<0){
                        alert("Numero no valido");
                    }else{
                        $scope.pagoCredito=$scope.payment[0]; 
                        crudServiceOrderSales.search('cashes',$scope.cash1.cashHeader_id,1).then(function (data){
                        var canCashes=data.total;
                        var pagActual=Math.ceil(canCashes/15);
                            //alert(pagActual);

                            crudServiceOrderSales.search('cashes',$scope.cash1.cashHeader_id,pagActual).then(function (data){    
                                $scope.cashes = data.data;

                                $scope.cashfinal=$scope.cashes[$scope.cashes.length-1];

                                if ($scope.cashfinal.estado=='1') {

                                    $scope.detCash={};
                                    $scope.mostrarAlmacenCaja();

                                    $scope.detCash.cash_id=$scope.cashfinal.id; 
                                    $scope.detCash.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate();
                                    $scope.detCash.hora=$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                                    $scope.detCash.montoCaja=$scope.cashfinal.montoBruto;
                                    $scope.detCash.cashMotive_id='17';

                                    if ($scope.detPago.saleMethodPayment_id=='1') {
                                        $scope.detCash.montoMovimientoEfectivo=Number($scope.detPago.monto);
                                        $scope.detCash.montoMovimientoTarjeta=0;
                                        
                                    }else{
                                        $scope.detCash.montoMovimientoTarjeta=Number($scope.detPago.monto);
                                        $scope.detCash.montoMovimientoEfectivo=0;         
                                    }                        
                        
                                    $scope.detCash.montoFinal=Number($scope.detCash.montoCaja)+$scope.detCash.montoMovimientoTarjeta+$scope.detCash.montoMovimientoEfectivo;
                                    $scope.detCash.estado='1';

                                    $scope.cashfinal.ingresos=Number($scope.cashfinal.ingresos)+Number($scope.detCash.montoMovimientoTarjeta)+Number($scope.detCash.montoMovimientoEfectivo); 
                                    $scope.cashfinal.montoBruto=$scope.detCash.montoFinal;
                                    //////////////////////////////////////////////
                                    $scope.pagoCredito.movimiento=$scope.detCash; 
                                    $scope.pagoCredito.caja=$scope.cashfinal;



                    
                                    if(Number($scope.pagoCredito.Saldo)>=$scope.detPago.monto){
                                        $scope.pagoCredito.Acuenta=Number($scope.pagoCredito.Acuenta)+$scope.detPago.monto;
                                        $scope.pagoCredito.Saldo=Number($scope.pagoCredito.Saldo)-$scope.detPago.monto;

                                        $scope.detPago.salePayment_id=$scope.payment[0].id;

                                        $scope.pagoCredito.detPayments=$scope.detPago;
                                        //--------------
                                        crudServiceOrderSales.byId($scope.pagoCredito.orderSale_id,'orderSales').then(function (data) {
                                                $scope.saleCredito=data;
                                                
                                                $scope.pagoCredito.sale=$scope.saleCredito;
                                                $log.log($scope.pagoCredito);

                                            crudServiceOrderSales.create($scope.pagoCredito, 'saledetPayments').then(function (data) {
                          
                                                if (data['estado'] == true) {
                                
                                                    alert('grabado correctamente');
                                                    $scope.paginateDetPay($scope.detPago.salePayment_id);
                                                    $scope.pagoCredito={};
                                                    $scope.detPago={};
                                                } else {
                                                    $scope.errors = data;

                                                }
                                            });
                                        });
                                    }else{
                                        alert("Pago mayor a la deuda");
                                    }

                            }else{alert("Caja Cerrada");}
                            });
                        }); 
                    }

                }
                $scope.paginateDetPay=function(idP){
                      crudServiceOrderSales.byId(idP,'saledetPayments').then(function (data) {
                        $scope.detPayments = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 5;

                    });
                }

                
            }]);

})();
<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Cuentas Bancarias
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/cuentaBancarias">Cuentas Bancarias</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Cuenta Bancaria</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="cuentaBancariaEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                                            
                   <div class="form-group" ng-class="{'has-error': cuentaBancariaEditForm.cuentaBancaria.$invalid,'has-success':cuentaBancariaEditForm.cuentaBancaria.$invalid}">
                      <label for="numeroCuenta">Numero de Cuenta </label>
                      <input type="text" class="form-control" name="cuentaBancaria" ng-blur="validanomUbigeo(cuentaBancaria.numeroCuenta)" placeholder=" Numero de Cuenta" ng-model="cuentaBancaria.numeroCuenta" required>
                      <label ng-show="cuentaBancariaEditForm.cuentaBancaria.$error.required">
                        <span ng-show="cuentaBancariaEditForm.cuentaBancaria.$error.required"><i class="fa fa-times-circle-o"></i>El campo Numero de Cuenta es Requerido. 
                        </span>
                      </label>
                    </div>

                     <div class="form-group" ng-class="{'has-error': cuentaBancariaEditForm.banco_id.$invalid,'has-success':cuentaBancariaEditForm.banco_id.$invalid}">
                        <label>Banco</label>
                        <select class="form-control ng-pristine ng-valid ng-touched" name="banco_id" ng-model="cuentaBancaria.banco_id" ng-options="item.id as item.nombre for item in bancos" required><option value="">-- Elige Banco --</option></select>
                        <label ng-show="cuentaBancariaEditForm.banco_id.$error.required">
                        <span ng-show="cuentaBancariaEditForm.banco_id.$error.required"><i class="fa fa-times-circle-o"></i>Debe selecionar un Banco. 
                        </span>
                      </label>
                    </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-disabled="cuentaBancariaEditForm.$invalid" ng-click="updateCuentaBancaria()">Modificar</button>
                    <a href="/cuentaBancarias" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
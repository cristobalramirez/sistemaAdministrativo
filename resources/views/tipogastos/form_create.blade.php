<section class="content-header">
          <h1>
            Tipo de Gastos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/tipogastos">Tipo de Gastos</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Tipo Gasto</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="tipoGastoCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="tipoGastoCreateForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                </div>

                    
                   <div class="form-group" ng-class="{'has-error': tipoGastoCreateForm.descripcion.$invalid,'has-success':tipoGastoCreateForm.descripcion.$invalid}">
                      <label for="descripcion">Descripcion * </label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Descripcion" ng-model="tipogasto.descripcion" required>
                    </div>

                    <div class="form-group" ng-class="{'has-error': tipoGastoCreateForm.tipo.$invalid,'has-success':tipoGastoCreateForm.tipo.$invalid}">
                      <label for="tipo">Tipo * </label>
                      <input type="text" class="form-control" name="tipo" placeholder="Tipo" ng-model="tipogasto.tipo" required>
                    </div>


                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" ng-disabled="tipoGastoCreateForm.$invalid" class="btn btn-primary" ng-click="createTipoGasto()">Crear</button>
                    <a href="/tipogastos" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
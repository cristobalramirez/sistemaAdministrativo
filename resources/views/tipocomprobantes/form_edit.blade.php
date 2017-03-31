<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Tipo de Comprobantes
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/tipocomprobantes">Tipo de Comprobantes</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Comprobante</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="tipoComprobanteEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="tipoComprobanteEditForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                    </div>
                    
                   <div class="form-group" ng-class="{'has-error': tipoComprobanteEditForm.numero.$invalid,'has-success':tipoComprobanteEditForm.numero.$invalid}">
                      <label for="numero">Numero * </label>
                      <input type="text" class="form-control" name="numero" placeholder="Numero" ng-model="tipocomprobante.numero" required>
                    </div>

                   <div class="form-group" ng-class="{'has-error': tipoComprobanteEditForm.descripcion.$invalid,'has-success':tipoComprobanteEditForm.descripcion.$invalid}">
                      <label for="descripcion">Descripcion * </label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Descripcion" ng-model="tipocomprobante.descripcion" required>
                    </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-disabled="tipoComprobanteEditForm.$invalid" ng-click="updateTipoComprobante()">Modificar</button>
                    <a href="/tipocomprobantes" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
<section class="content-header">
          <h1>
            Tipo de comprobantes
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/tipocomprobantes">Tipo de comprobantes</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Tipo Comprobante</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="tipoComprobanteCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="tipoComprobanteCreateForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                </div>

                    <div class="form-group" ng-class="{'has-error': tipoComprobanteCreateForm.numero.$invalid,'has-success':tipoComprobanteCreateForm.numero.$invalid}">
                      <label for="numero">Numero * </label>
                      <input type="text" class="form-control" name="numero" placeholder="Numero" ng-model="tipocomprobante.numero" required>
                    </div>

                   <div class="form-group" ng-class="{'has-error': tipoComprobanteCreateForm.descripcion.$invalid,'has-success':tipoComprobanteCreateForm.descripcion.$invalid}">
                      <label for="descripcion">Descripcion * </label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Descripcion" ng-model="tipocomprobante.descripcion" required>
                    </div>

                    


                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" ng-disabled="tipoComprobanteCreateForm.$invalid" class="btn btn-primary" ng-click="createTipoComprobante()">Crear</button>
                    <a href="/tipocomprobantes" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
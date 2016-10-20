<section class="content-header">
          <h1>
            Promociones
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/promociones">Promociones</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Promocion</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="promocionCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="promocionCreateForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                </div> 
                    
                   <div class="form-group" ng-class="{'has-error': promocionCreateForm.descripcion.$invalid,'has-success':promocionCreateForm.descripcion.$invalid}">
                      <label for="descripcion">Nombre * </label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Nombre" ng-model="promocion.descripcion" required>
                      
                    </div>

                    <div class="form-group" ng-class="{'has-error': promocionCreateForm.porcentajeDescuento.$invalid,'has-success':promocionCreateForm.porcentajeDescuento.$invalid}">
                      <label for="porcentajeDescuento">Procentaje * </label>
                      <input type="number" min="0" max="100" class="form-control" name="porcentajeDescuento" placeholder="Procentaje" ng-model="promocion.porcentajeDescuento" required>
                      
                    </div>
                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-disabled="promocionCreateForm.$invalid" ng-click="createPromocion()">Crear</button>
                    <a href="/promociones" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
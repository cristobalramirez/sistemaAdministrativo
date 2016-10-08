<section class="content-header">
          <h1>
            Medios Publicitarios
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/medioPublicitarios">Medios Publicitarios</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Medio Publicitario</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="callout callout-danger" ng-show="medioPublicitarioCreateForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                </div>
                <form name="medioPublicitarioCreateForm" role="form" novalidate>
                  <div class="box-body">
                                      
                   <div class="form-group" ng-class="{'has-error': medioPublicitarioCreateForm.descripcion.$invalid,'has-success':medioPublicitarioCreateForm.descripcion.$invalid}">
                      <label for="descripcion">Descripcion *</label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Descripcion" ng-model="medioPublicitario.descripcion" required>
                      
                    </div>
                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-disabled="medioPublicitarioCreateForm.$invalid" ng-click="createMedioPublicitario()">Crear</button>
                    <a href="/medioPublicitarios" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
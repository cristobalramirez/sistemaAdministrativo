<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Medios Publicitarios
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/medioPublicitarios">Medios Publicitarios</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Medio Publicitario</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="medioPublicitarioEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                     <div class="form-group" ng-class="{'has-error': medioPublicitarioEditForm.descripcion.$invalid,'has-success':medioPublicitarioEditForm.descripcion.$invalid}">
                      <label for="descripcion">Descripcion</label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Descripcion" ng-model="medioPublicitario.descripcion" required>
                      <label ng-show="medioPublicitarioEditForm.descripcion.$error.required">
                        <span ng-show="medioPublicitarioEditForm.descripcion.$error.required"><i class="fa fa-times-circle-o"></i>El campo Descripcion es Requerido. 
                        </span>
                      </label>
                    </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-disabled="medioPublicitarioEditForm.$invalid" ng-click="updateMedioPublicitario()">Modificar</button>
                    <a href="/medioPublicitarios" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
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
                <form name="medioPublicitarioCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                   <div class="form-group" ng-class="{true: 'has-error'}[ medioPublicitarioCreateForm.descripcion.$error.required && medioPublicitarioCreateForm.$submitted || medioPublicitarioCreateForm.descripcion.$dirty && medioPublicitarioCreateForm.descripcion.$invalid]">
                      <label for="descripcion">Descripcion</label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Descripcion" ng-model="medioPublicitario.descripcion" required>
                      <label ng-show="medioPublicitarioCreateForm.$submitted || medioPublicitarioCreateForm.descripcion.$dirty && medioPublicitarioCreateForm.descripcion.$invalid">
                        <span ng-show="medioPublicitarioCreateForm.descripcion.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createMedioPublicitario()">Crear</button>
                    <a href="/medioPublicitarios" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
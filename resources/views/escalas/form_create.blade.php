<section class="content-header">
          <h1>
            Escalas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/escalas">Escalas</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Escala</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="escalaCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="escalaCreateForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                </div>                    

                   <div class="form-group" ng-class="{'has-error': escalaCreateForm.descripcion.$invalid,'has-success':escalaCreateForm.descripcion.$invalid}">
                      <label for="descripcion">Descripcion * </label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Descripcion" ng-model="escala.descripcion" required>
                    </div>

                    <div>
                      <label for="glosa">Glosa </label>
                      <input type="text" class="form-control" name="glosa" placeholder="Glosa" ng-model="escala.glosa">
                    </div>

                    


                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" ng-disabled="escalaCreateForm.$invalid" class="btn btn-primary" ng-click="createEscala()">Crear</button>
                    <a href="/escalas" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
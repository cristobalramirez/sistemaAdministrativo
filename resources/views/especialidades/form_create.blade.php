<section class="content-header">
          <h1>
            Especialidades
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/especialidades">Especialidades</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Especialidad</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="especialidadCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="especialidadCreateForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                </div>                    

                   <div class="form-group" ng-class="{'has-error': especialidadCreateForm.descripcion.$invalid,'has-success':especialidadCreateForm.descripcion.$invalid}">
                      <label for="descripcion">Descripcion * </label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Descripcion" ng-model="especialidad.descripcion" required>
                    </div>

                    <div>
                      <label for="glosa">Glosa </label>
                      <input type="text" class="form-control" name="glosa" placeholder="Glosa" ng-model="especialidad.glosa">
                    </div> 

                    


                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" ng-disabled="especialidadCreateForm.$invalid" class="btn btn-primary" ng-click="createEspecialidad()">Crear</button>
                    <a href="/especialidades" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
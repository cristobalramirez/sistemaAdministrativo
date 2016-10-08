<section class="content-header">
          <h1>
            Paises
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/paises">Paises</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Pais</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="paisCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="paisCreateForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                </div>
                    
                   <div class="form-group" ng-class="{'has-error': paisCreateForm.nombre.$invalid,'has-success':paisCreateForm.nombre.$invalid}">
                      <label for="nombre">Nombre * </label>
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre" ng-model="pais.nombre" required>
                      
                    </div>
                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-disabled="paisCreateForm.$invalid" ng-click="createPais()">Crear</button>
                    <a href="/paises" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
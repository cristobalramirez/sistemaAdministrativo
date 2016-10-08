<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Profesiones
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/profesiones">Profesiones</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Profesion</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="profesionEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="profesionEditForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                </div>
                    
                     <div class="form-group" ng-class="{'has-error': profesionEditForm.nombre.$invalid,'has-success':profesionEditForm.nombre.$invalid}">
                      <label for="nombre">Nombre * </label>
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre" ng-model="profesion.nombre" required>
                      <label ng-show="profesionEditForm.nombre.$error.required">
                        <span ng-show="profesionEditForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>El campo Nombre es Requerido. 
                        </span>
                      </label>
                    </div>

                     <div class="form-group" >
                      <label for="descripcion">Descripcion</label>
                      <textarea type="descripcion" class="form-control" name="descripcion" placeholder="Descripcion"
                      ng-model="profesion.descripcion" rows="4" cols="50"></textarea>
                     </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-disabled="profesionEditForm.$invalid" ng-click="updateProfesion()">Modificar</button>
                    <a href="/profesiones" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
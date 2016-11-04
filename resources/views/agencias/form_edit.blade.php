<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Agencias
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/agencias">Agencias</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Agencia</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="agenciaEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="agenciaEditForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                    </div>
                    
                   <div class="form-group" ng-class="{'has-error': agenciaEditForm.nombre.$invalid,'has-success':agenciaEditForm.nombre.$invalid}">
                      <label for="nombre">Nombre * </label>
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre" ng-model="agencia.nombre" required>
                     
                    </div>

                    <div class="form-group" >
                      <label for="notas">Descripción</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="..." ng-model="agencia.descripcion" rows="3" cols="50"></textarea>
                    </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-disabled="agenciaEditForm.$invalid" ng-click="updateAgencia()">Modificar</button>
                    <a href="/agencias" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
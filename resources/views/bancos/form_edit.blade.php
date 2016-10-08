<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Bancos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/bancos">Bancos</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Banco</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="bancoEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="bancoEditForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                </div>
                    
                     <div class="form-group" ng-class="{'has-error': bancoEditForm.nombre.$invalid,'has-success':bancoEditForm.nombre.$invalid}">
                      <label for="nombre">Nombre * </label>
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre" ng-model="banco.nombre" required>
                      
                    </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-disabled="bancoEditForm.$invalid" ng-click="updateBanco()">Modificar</button>
                    <a href="/bancos" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
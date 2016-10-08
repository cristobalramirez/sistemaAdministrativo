<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Ubigeos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/ubigeos">Ubigeos</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Ubigeo</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="ubigeoEditForm" role="form" novalidate>
                  <div class="box-body">                     
                    
                   <div class="callout callout-danger" ng-show="ubigeoEditForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                    </div>
                    
                   <form name="ubigeoEditForm" role="form" novalidate>
                  <div class="box-body">

                  <div class="form-group" ng-class="{'has-error': ubigeoEditForm.codigo.$invalid,'has-success':ubigeoEditForm.codigo.$invalid}">
                      <label for="codigo">Codigo * </label>
                      <input ng-blur="validanomUbigeo(ubigeo.codigo)" type="number" class="form-control" name="codigo" placeholder="Codigo" ng-model="ubigeo.codigo" required>
                      </div>

                    <div class="form-group" ng-class="{'has-error': ubigeoEditForm.departamento.$invalid,'has-success':ubigeoEditForm.departamento.$invalid}">
                      <label for="departamento">Departamento * </label>
                      <input type="text" class="form-control" name="departamento" placeholder="Departamento" ng-model="ubigeo.departamento" required>
                  
                    </div>

                    <div class="form-group" ng-class="{'has-error': ubigeoEditForm.provincia.$invalid,'has-success':ubigeoEditForm.provincia.$invalid}">
                      <label for="provincia">Provincia *</label>
                      <input type="text" class="form-control" name="provincia" placeholder="Provincia" ng-model="ubigeo.provincia" required>
                      </div>

                    <div class="form-group" ng-class="{'has-error': ubigeoEditForm.distrito.$invalid,'has-success':ubigeoEditForm.distrito.$invalid}">
                      <label for="distrito">Distrito *</label>
                      <input type="text" class="form-control" name="distrito" placeholder="Distrito" ng-model="ubigeo.distrito" required>
                      </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" ng-disabled="ubigeoEditForm.$invalid" class="btn btn-primary" ng-click="updateUbigeo()">Modificar</button>
                    <a href="/ubigeos" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
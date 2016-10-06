<section class="content-header">
          <h1>
            Ubigeos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/ubigeos">Ubigeos</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Ubigeo</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="ubigeoCreateForm" role="form" novalidate>
                  <div class="box-body">

                  <div class="form-group" ng-class="{'has-error': ubigeoCreateForm.codigo.$invalid,'has-success':ubigeoCreateForm.codigo.$invalid}">
                      <label for="codigo">Codigo</label>
                      <input ng-blur="validanomUbigeo(ubigeo.codigo)" type="number" class="form-control" name="codigo" placeholder="Codigo" ng-model="ubigeo.codigo" required>
                      <label ng-show="ubigeoCreateForm.codigo.$error.required">
                        <span ng-show="ubigeoCreateForm.codigo.$error.required"><i class="fa fa-times-circle-o"></i>El campo Codigo Requerido. 
                        </span>
                      </label>
                    </div>

                    <div class="form-group" ng-class="{'has-error': ubigeoCreateForm.departamento.$invalid,'has-success':ubigeoCreateForm.departamento.$invalid}">
                      <label for="departamento">Departamento</label>
                      <input type="text" class="form-control" name="departamento" placeholder="Departamento" ng-model="ubigeo.departamento" required>
                      <label ng-show="ubigeoCreateForm.departamento.$error.required">
                        <span ng-show="ubigeoCreateForm.departamento.$error.required"><i class="fa fa-times-circle-o"></i>El campo Departamento Requerido. 
                        </span>
                      </label>
                    </div>

                    <div class="form-group" ng-class="{'has-error': ubigeoCreateForm.provincia.$invalid,'has-success':ubigeoCreateForm.provincia.$invalid}">
                      <label for="provincia">Provincia</label>
                      <input type="text" class="form-control" name="provincia" placeholder="Provincia" ng-model="ubigeo.provincia" required>
                      <label ng-show="ubigeoCreateForm.provincia.$error.required">
                        <span ng-show="ubigeoCreateForm.provincia.$error.required"><i class="fa fa-times-circle-o"></i>El campo Provincia Requerido. 
                        </span>
                      </label>
                    </div>

                    <div class="form-group" ng-class="{'has-error': ubigeoCreateForm.distrito.$invalid,'has-success':ubigeoCreateForm.distrito.$invalid}">
                      <label for="distrito">Distrito</label>
                      <input type="text" class="form-control" name="distrito" placeholder="Distrito" ng-model="ubigeo.distrito" required>
                      <label ng-show="ubigeoCreateForm.distrito.$error.required">
                        <span ng-show="ubigeoCreateForm.distrito.$error.required"><i class="fa fa-times-circle-o"></i>El campo Distrito Requerido. 
                        </span>
                      </label>
                    </div>
                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-disabled="ubigeoCreateForm.$invalid" ng-click="createUbigeo()">Crear</button>
                    <a href="/ubigeos" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
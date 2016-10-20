<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Empleados
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/empleados">Empleados</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Empleado</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="empleadoEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="empleadoEditForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                </div>
                    
                   <div class="form-group" ng-class="{'has-error': empleadoEditForm.nombres.$invalid,'has-success':empleadoEditForm.nombres.$invalid}">
                      <label for="nombres">Nombres * </label>
                      <input type="text" class="form-control" name="nombres"  placeholder="Nombres" ng-model="empleado.nombres" required>                      
                    </div>

                    <div class="form-group" ng-class="{'has-error': empleadoEditForm.apellidos.$invalid,'has-success':empleadoEditForm.apellidos.$invalid}">
                      <label for="apellidos">Apellidos * </label>
                      <input type="text" class="form-control" name="apellidos"  placeholder="Apellidos" ng-model="empleado.apellidos" required>
                    </div>
                    
                    <div class="row">
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': empleadoEditForm.dni.$invalid,'has-success':empleadoEditForm.dni.$invalid}">
                          <label for="dni">DNI * </label>
                          <input ng-blur="validaDni(empleado.dni)" type="number" class="form-control" name="dni"  placeholder="DNI" ng-model="empleado.dni" required>
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div  class="form-group">
                                  <label for="fechaNacimiento">Fecha de Nacimiento</label>
                              <div  class="input-group">
                                  <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                 </div>
                                    <input  type="date" ng-change="filtroFechas()" class="form-control"  name="fechaNacimiento" ng-model="empleado.fechaNac">
                              </div>
                        </div>
                      </div>

                    <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': empleadoEditForm.sexo.$invalid,'has-success':empleadoEditForm.sexo.$invalid}">
                              <label>Sexo</label>
                              <select class="form-control ng-pristine ng-valid ng-touched" name="sexo" ng-model="empleado.sexo" required=""><option value="">-- Elige Sexo --</option>
                              <option value="Masculino">Masculino</option>
                              <option value="Femenino">Femenino</option></select>
                          </div>
                      </div>

                      </div>


                      <div class="row">
                      
                      <div  class="col-md-6">
                        <div  class="form-group">
                                  <label for="fecIngreso">Fecha de Ingreso</label>
                              <div  class="input-group">
                                  <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                 </div>
                                    <input  type="date" ng-change="filtroFechas()" class="form-control"  name="fecIngreso" ng-model="empleado.fecIngreso">
                              </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div  class="form-group">
                                  <label for="fecBaja">Fecha de Baja</label>
                              <div  class="input-group">
                                  <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                 </div>
                                    <input  type="date" ng-change="filtroFechas()" class="form-control"  name="fecBaja" ng-model="empleado.fecBaja">
                              </div>
                        </div>
                      
                    </div>
                    </div>

                    <div class="row">
                      <div  class="col-md-8">
                        <div class="form-group" ng-class="{'has-error': empleadoEditForm.email.$invalid,'has-success':empleadoEditForm.email.$invalid}">
                          <label for="email">Email * </label>
                          <input type="email" class="form-control" name="email"  placeholder="Email" ng-model="empleado.email" required>
                        </div>
                      </div>
                      
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': empleadoEditForm.telefono.$invalid,'has-success':empleadoEditForm.telefono.$invalid}">
                          <label for="telefono">Telefono * </label>
                          <input type="number" class="form-control" name="telefono"  placeholder="Telefono" ng-model="empleado.telefono" required>
                        </div>
                      </div>

                      
                    </div>

                    <div class="form-group" ng-class="{'has-error': empleadoEditForm.direccion.$invalid,'has-success':empleadoEditForm.direccion.$invalid}">
                      <label for="direccion">Diereccion * </label>
                      <input type="text" class="form-control" name="direccion"  placeholder="Diereccion" ng-model="empleado.direccion" required>                      
                    </div>

                    <div class="row">
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': empleadoEditForm.departamento.$invalid,'has-success':empleadoEditForm.departamento.$invalid}">
                            <label>Departamento * </label>
                            <select ng-click="CargarProvincia()" class="form-control ng-pristine ng-valid ng-touched" name="departamento" ng-model="DepertamentoSelect" ng-options="item.departamento as item.departamento for item in Departamentos" required><option value="">-- Elige Departamento --</option></select>  
                        </div>
                      </div>
                      
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': empleadoEditForm.provincia.$invalid,'has-success':empleadoEditForm.provincia.$invalid}">
                            <label>Provinca * </label>
                            <select ng-disabled="DepertamentoSelect==null" ng-click="CargarDistrito()" class="form-control ng-pristine ng-valid ng-touched" name="provincia" ng-model="ProvinciaSelect" ng-options="item.provincia as item.provincia for item in Provincias" required><option value="">-- Elige Provincia --</option></select>
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': empleadoEditForm.distrito.$invalid,'has-success':empleadoEditForm.distrito.$invalid}">
                            <label>Distrito * </label>
                            <select ng-disabled="DepertamentoSelect==null || ProvinciaSelect==undefined" class="form-control ng-pristine ng-valid ng-touched" name="distrito" ng-model="DistritoSelect" ng-options="item.id as item.distrito for item in Distritos" required><option value="">-- Elige Distrito --</option></select>
                        </div>
                      </div>
                    </div>
                    



                    
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button ng-disabled="empleadoEditForm.$invalid" vtype="submit" class="btn btn-primary" ng-click="updateEmpleado()">Modificar</button>
                    <a   href="/empleados" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
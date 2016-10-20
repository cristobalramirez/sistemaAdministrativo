<section class="content-header">
          <h1>
            Empleados
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/empleados">Empleados</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Empleado</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="empleadoCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="empleadoCreateForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                </div>
                    
                   <div class="form-group" ng-class="{'has-error': empleadoCreateForm.nombres.$invalid,'has-success':empleadoCreateForm.nombres.$invalid}">
                      <label for="nombres">Nombres * </label>
                      <input type="text" class="form-control" name="nombres"  placeholder="Nombres" ng-model="empleado.nombres" required>                      
                    </div>

                    <div class="form-group" ng-class="{'has-error': empleadoCreateForm.apellidos.$invalid,'has-success':empleadoCreateForm.apellidos.$invalid}">
                      <label for="apellidos">Apellidos * </label>
                      <input type="text" class="form-control" name="apellidos"  placeholder="Apellidos" ng-model="empleado.apellidos" required>
                    </div>
                    
                    <div class="row">
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': empleadoCreateForm.dni.$invalid,'has-success':empleadoCreateForm.dni.$invalid}">
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
                        <div class="form-group" ng-class="{'has-error': empleadoCreateForm.sexo.$invalid,'has-success':empleadoCreateForm.sexo.$invalid}">
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
                        <div class="form-group" ng-class="{'has-error': empleadoCreateForm.email.$invalid,'has-success':empleadoCreateForm.email.$invalid}">
                          <label for="email">Email * </label>
                          <input type="email" class="form-control" name="email"  placeholder="Email" ng-model="empleado.email" required>
                        </div>
                      </div>
                      
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': empleadoCreateForm.telefono.$invalid,'has-success':empleadoCreateForm.telefono.$invalid}">
                          <label for="telefono">Telefono * </label>
                          <input type="number" class="form-control" name="telefono"  placeholder="Telefono" ng-model="empleado.telefono" required>
                        </div>
                      </div>

                      
                    </div>

                    <div class="form-group" ng-class="{'has-error': empleadoCreateForm.direccion.$invalid,'has-success':empleadoCreateForm.direccion.$invalid}">
                      <label for="direccion">Diereccion * </label>
                      <input type="text" class="form-control" name="direccion"  placeholder="Diereccion" ng-model="empleado.direccion" required>                      
                    </div>

                    <div class="row">
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': empleadoCreateForm.departamento.$invalid,'has-success':empleadoCreateForm.departamento.$invalid}">
                            <label>Departamento * </label>
                            <select ng-click="CargarProvincia()" class="form-control ng-pristine ng-valid ng-touched" name="departamento" ng-model="DepertamentoSelect" ng-options="item.departamento as item.departamento for item in Departamentos" required><option value="">-- Elige Departamento --</option></select>  
                        </div>
                      </div>
                      
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': empleadoCreateForm.provincia.$invalid,'has-success':empleadoCreateForm.provincia.$invalid}">
                            <label>Provinca * </label>
                            <select ng-disabled="DepertamentoSelect==null" ng-click="CargarDistrito()" class="form-control ng-pristine ng-valid ng-touched" name="provincia" ng-model="ProvinciaSelect" ng-options="item.provincia as item.provincia for item in Provincias" required><option value="">-- Elige Provincia --</option></select>
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': empleadoCreateForm.distrito.$invalid,'has-success':empleadoCreateForm.distrito.$invalid}">
                            <label>Distrito * </label>
                            <select ng-disabled="DepertamentoSelect==null || ProvinciaSelect==undefined" class="form-control ng-pristine ng-valid ng-touched" name="distrito" ng-model="DistritoSelect" ng-options="item.id as item.distrito for item in Distritos" required><option value="">-- Elige Distrito --</option></select>
                        </div>
                      </div>
                    </div>
                    
                    


                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button ng-disabled="empleadoCreateForm.$invalid" type="submit" class="btn btn-primary" ng-click="createEmpleado()"  >Crear</button>
                    <a ng-disabled="banderaCargando" href="/empleados" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
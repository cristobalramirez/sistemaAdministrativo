<section class="content-header">
          <h1>
            Docentes
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/docentes">Docentes</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Docente</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="docenteCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors"> 
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                   <div class="form-group" ng-class="{true: 'has-error'}[ docenteCreateForm.nombres.$error.required && docenteCreateForm.$submitted || docenteCreateForm.z.$dirty && docenteCreateForm.nombres.$invalid]">
                      <label for="nombres">Nombres</label>
                      <input type="text" class="form-control" name="nombres"  placeholder="Nombres" ng-model="docente.nombres" required>
                      <label ng-show="docenteCreateForm.$submitted || docenteCreateForm.nombres.$dirty && docenteCreateForm.nombres.$invalid">
                        <span ng-show="docenteCreateForm.nombres.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    <div class="form-group" ng-class="{true: 'has-error'}[ docenteCreateForm.apellidos.$error.required && docenteCreateForm.$submitted || docenteCreateForm.z.$dirty && docenteCreateForm.apellidos.$invalid]">
                      <label for="apellidos">Apellidos</label>
                      <input type="text" class="form-control" name="apellidos"  placeholder="Apellidos" ng-model="docente.apellidos" required>
                      <label ng-show="docenteCreateForm.$submitted || docenteCreateForm.apellidos.$dirty && docenteCreateForm.apellidos.$invalid">
                        <span ng-show="docenteCreateForm.apellidos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    
                    <div class="row">
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{true: 'has-error'}[ docenteCreateForm.dni.$error.required && docenteCreateForm.$submitted || docenteCreateForm.z.$dirty && docenteCreateForm.dni.$invalid]">
                          <label for="dni">DNI</label>
                          <input ng-blur="validaDni(docente.dni)" type="text" class="form-control" name="dni"  placeholder="DNI" ng-model="docente.dni" required>
                          <label ng-show="docenteCreateForm.$submitted || docenteCreateForm.dni.$dirty && docenteCreateForm.dni.$invalid">
                            <span ng-show="docenteCreateForm.dni.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div  class="form-group">
                                  <label for="fechaNacimiento">Fecha de Nacimiento</label>
                              <div  class="input-group">
                                  <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                 </div>
                                    <input  type="date" ng-change="filtroFechas()" class="form-control"  name="fechaNacimiento" ng-model="docente.fechaNac">
                              </div>
                        </div>
                      </div>

                    <div  class="col-md-4">
                        <div>
                              <label>Sexo</label>
                              <select class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="docente.sexo"><option value="">-- Elige Sexo --</option>
                              <option value="Masculino">Masculino</option>
                              <option value="Femenino">Femenino</option></select>
                          </div>
                      </div>

                      </div>


                      <div class="row">
                      <div  class="col-md-4">
                        <div  class="form-group">
                                  <label for="fechaRegistro">Fecha de Registro</label>
                              <div  class="input-group">
                                  <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                 </div>
                                    <input  type="date" ng-change="filtroFechas()" class="form-control"  name="fechaRegistro" ng-model="docente.fechaRegistro">
                              </div>
                        </div>
                      </div>
                      
                      <div  class="col-md-4">
                        <div>
                            <label>Profesion</label>
                            <select ng-click="cargarDistrito()" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="docente.profesion_id" ng-options="item.id as item.nombre for item in profesiones"><option value="">-- Elige Profesion --</option></select>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group" ng-class="{true: 'has-error'}[ docenteCreateForm.gradoAcademico.$error.required && docenteCreateForm.$submitted || docenteCreateForm.z.$dirty && docenteCreateForm.gradoAcademico.$invalid]">
                          <label for="gradoAcademico">Grado Academico</label>
                          <input type="text" class="form-control" name="gradoAcademico"  placeholder="Grado Academico" ng-model="docente.gradoAcademico" required>
                          <label ng-show="docenteCreateForm.$submitted || docenteCreateForm.gradoAcademico.$dirty && docenteCreateForm.gradoAcademico.$invalid">
                            <span ng-show="docenteCreateForm.gradoAcademico.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                        </div>
                      
                    </div>
                    </div>

                    <div class="row">
                      <div  class="col-md-8">
                        <div class="form-group" ng-class="{true: 'has-error'}[ docenteCreateForm.email.$error.required && docenteCreateForm.$submitted || docenteCreateForm.z.$dirty && docenteCreateForm.email.$invalid]">
                          <label for="email">Email</label>
                          <input type="text" class="form-control" name="email"  placeholder="Email" ng-model="docente.email" required>
                          <label ng-show="docenteCreateForm.$submitted || docenteCreateForm.email.$dirty && docenteCreateForm.email.$invalid">
                            <span ng-show="docenteCreateForm.email.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                        </div>
                      </div>
                      
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{true: 'has-error'}[ docenteCreateForm.telefono.$error.required && docenteCreateForm.$submitted || docenteCreateForm.z.$dirty && docenteCreateForm.telefono.$invalid]">
                          <label for="telefono">Telefono</label>
                          <input type="text" class="form-control" name="telefono"  placeholder="Telefono" ng-model="docente.telefono" required>
                          <label ng-show="docenteCreateForm.$submitted || docenteCreateForm.telefono.$dirty && docenteCreateForm.telefono.$invalid">
                            <span ng-show="docenteCreateForm.telefono.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                        </div>
                      </div>

                      
                    </div>
                    
                    <div class="row">
                      <div  class="col-md-4">
                        <div class="form-group">
                          <label>Curriculum</label>
                          <input type="file" name="file" uploader-model="file" />
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{true: 'has-error'}[ docenteCreateForm.pais.$error.required && docenteCreateForm.$submitted || docenteCreateForm.z.$dirty && docenteCreateForm.pais.$invalid]">
                          <label for="pais">Pais</label>
                          <input type="text" class="form-control" name="pais"  placeholder="Pais" ng-model="docente.pais" required>
                          <label ng-show="docenteCreateForm.$submitted || docenteCreateForm.pais.$dirty && docenteCreateForm.pais.$invalid">
                            <span ng-show="docenteCreateForm.pais.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{true: 'has-error'}[ docenteCreateForm.nacionalidad.$error.required && docenteCreateForm.$submitted || docenteCreateForm.z.$dirty && docenteCreateForm.nacionalidad.$invalid]">
                          <label for="nacionalidad">Nacionalidad</label>
                          <input type="text" class="form-control" name="nacionalidad"  placeholder="Nacionalidad" ng-model="docente.nacionalidad" required>
                          <label ng-show="docenteCreateForm.$submitted || docenteCreateForm.nacionalidad.$dirty && docenteCreateForm.nacionalidad.$invalid">
                            <span ng-show="docenteCreateForm.nacionalidad.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div  class="col-md-4">
                        <div>
                            <label>Departamento</label>
                            <select ng-click="CargarProvincia()" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="DepertamentoSelect" ng-options="item.departamento as item.departamento for item in Departamentos"><option value="">-- Elige Departamento --</option></select>
                        </div>
                      </div>
                      
                      <div  class="col-md-4">
                        <div>
                            <label>Provinca</label>
                            <select ng-disabled="DepertamentoSelect==null" ng-click="CargarDistrito()" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="ProvinciaSelect" ng-options="item.provincia as item.provincia for item in Provincias"><option value="">-- Elige Provincia --</option></select>
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div>
                            <label>Distrito</label>
                            <select ng-disabled="DepertamentoSelect==null || ProvinciaSelect==undefined" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="DistritoSelect" ng-options="item.id as item.distrito for item in Distritos"><option value="">-- Elige Distrito --</option></select>
                        </div>
                      </div>
                    </div>
                    
                    


                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button ng-disabled="banderaCargando" type="submit" class="btn btn-primary" ng-click="uploadFile()">Crear</button>
                    <a ng-disabled="banderaCargando" href="/docentes" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
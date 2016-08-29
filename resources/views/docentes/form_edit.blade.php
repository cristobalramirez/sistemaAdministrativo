<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Docentes
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/docentes">Docentes</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Docente</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="DocenteEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    

                  <div class="form-group" ng-class="{true: 'has-error'}[ DocenteEditForm.nombres.$error.required && DocenteEditForm.$submitted || DocenteEditForm.z.$dirty && DocenteEditForm.nombres.$invalid]">
                      <label for="nombres">Nombres</label>
                      <input type="text" class="form-control" name="nombres"  placeholder="Nombres" ng-model="docente.nombres" required>
                      <label ng-show="DocenteEditForm.$submitted || DocenteEditForm.nombres.$dirty && DocenteEditForm.nombres.$invalid">
                        <span ng-show="DocenteEditForm.nombres.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>

                    <div class="form-group" ng-class="{true: 'has-error'}[ DocenteEditForm.apellidos.$error.required && DocenteEditForm.$submitted || DocenteEditForm.z.$dirty && DocenteEditForm.apellidos.$invalid]">
                      <label for="apellidos">Apellidos</label>
                      <input type="text" class="form-control" name="apellidos"  placeholder="Apellidos" ng-model="docente.apellidos" required>
                      <label ng-show="DocenteEditForm.$submitted || DocenteEditForm.apellidos.$dirty && DocenteEditForm.apellidos.$invalid">
                        <span ng-show="DocenteEditForm.apellidos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    
                    <div class="row">
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{true: 'has-error'}[ DocenteEditForm.dni.$error.required && DocenteEditForm.$submitted || DocenteEditForm.z.$dirty && DocenteEditForm.dni.$invalid]">
                          <label for="dni">DNI</label>
                          <input ng-blur="validaDni(docente.dni)" type="text" class="form-control" name="dni"  placeholder="DNI" ng-model="docente.dni" required>
                          <label ng-show="DocenteEditForm.$submitted || DocenteEditForm.dni.$dirty && DocenteEditForm.dni.$invalid">
                            <span ng-show="DocenteEditForm.dni.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
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
                        <div class="form-group" ng-class="{true: 'has-error'}[ DocenteEditForm.gradoAcademico.$error.required && DocenteEditForm.$submitted || DocenteEditForm.z.$dirty && DocenteEditForm.gradoAcademico.$invalid]">
                          <label for="gradoAcademico">Grado Academico</label>
                          <input type="text" class="form-control" name="gradoAcademico"  placeholder="Grado Academico" ng-model="docente.gradoAcademico" required>
                          <label ng-show="DocenteEditForm.$submitted || DocenteEditForm.gradoAcademico.$dirty && DocenteEditForm.gradoAcademico.$invalid">
                            <span ng-show="DocenteEditForm.gradoAcademico.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                        </div>
                      
                    </div>
                    </div>

                    <div class="row">
                      <div  class="col-md-8">
                        <div class="form-group" ng-class="{true: 'has-error'}[ DocenteEditForm.email.$error.required && DocenteEditForm.$submitted || DocenteEditForm.z.$dirty && DocenteEditForm.email.$invalid]">
                          <label for="email">Email</label>
                          <input type="text" class="form-control" name="email"  placeholder="Email" ng-model="docente.email" required>
                          <label ng-show="DocenteEditForm.$submitted || DocenteEditForm.email.$dirty && DocenteEditForm.email.$invalid">
                            <span ng-show="DocenteEditForm.email.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                        </div>
                      </div>
                      
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{true: 'has-error'}[ DocenteEditForm.telefono.$error.required && DocenteEditForm.$submitted || DocenteEditForm.z.$dirty && DocenteEditForm.telefono.$invalid]">
                          <label for="telefono">Telefono</label>
                          <input type="text" class="form-control" name="telefono"  placeholder="Telefono" ng-model="docente.telefono" required>
                          <label ng-show="DocenteEditForm.$submitted || DocenteEditForm.telefono.$dirty && DocenteEditForm.telefono.$invalid">
                            <span ng-show="DocenteEditForm.telefono.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                        </div>
                      </div>

                      
                    </div>
                    
                    <div class="row">
                      <div  class="col-md-4">
                        <div class="form-group">
                          <label>Curriculum</label>
                          <input type="file" name="file" uploader-model="file"/>
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{true: 'has-error'}[ DocenteEditForm.pais.$error.required && DocenteEditForm.$submitted || DocenteEditForm.z.$dirty && DocenteEditForm.pais.$invalid]">
                          <label for="pais">Pais</label>
                          <input type="text" class="form-control" name="pais"  placeholder="Pais" ng-model="docente.pais" required>
                          <label ng-show="DocenteEditForm.$submitted || DocenteEditForm.pais.$dirty && DocenteEditForm.pais.$invalid">
                            <span ng-show="DocenteEditForm.pais.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{true: 'has-error'}[ DocenteEditForm.nacionalidad.$error.required && DocenteEditForm.$submitted || DocenteEditForm.z.$dirty && DocenteEditForm.nacionalidad.$invalid]">
                          <label for="nacionalidad">Nacionalidad</label>
                          <input type="text" class="form-control" name="nacionalidad"  placeholder="Nacionalidad" ng-model="docente.nacionalidad" required>
                          <label ng-show="DocenteEditForm.$submitted || DocenteEditForm.nacionalidad.$dirty && DocenteEditForm.nacionalidad.$invalid">
                            <span ng-show="DocenteEditForm.nacionalidad.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
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
                    <button ng-disabled="banderaCargando"  vtype="submit" class="btn btn-primary" ng-click="editUploadFile()">Modificar</button>
                    <a ng-disabled="banderaCargando"  href="/docentes" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
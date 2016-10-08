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
                  <div class="callout callout-danger" ng-show="docenteCreateForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                </div>
                    
                   <div class="form-group" ng-class="{'has-error': docenteCreateForm.nombres.$invalid,'has-success':docenteCreateForm.nombres.$invalid}">
                      <label for="nombres">Nombres * </label>
                      <input type="text" class="form-control" name="nombres"  placeholder="Nombres" ng-model="docente.nombres" required>                      
                    </div>

                    <div class="form-group" ng-class="{'has-error': docenteCreateForm.apellidos.$invalid,'has-success':docenteCreateForm.apellidos.$invalid}">
                      <label for="apellidos">Apellidos * </label>
                      <input type="text" class="form-control" name="apellidos"  placeholder="Apellidos" ng-model="docente.apellidos" required>
                    </div>
                    
                    <div class="row">
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': docenteCreateForm.dni.$invalid,'has-success':docenteCreateForm.dni.$invalid}">
                          <label for="dni">DNI * </label>
                          <input ng-blur="validaDni(docente.dni)" type="number" class="form-control" name="dni"  placeholder="DNI" ng-model="docente.dni" required>
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
                        <div class="form-group" ng-class="{'has-error': docenteCreateForm.sexo.$invalid,'has-success':docenteCreateForm.sexo.$invalid}">
                              <label>Sexo</label>
                              <select class="form-control ng-pristine ng-valid ng-touched" name="sexo" ng-model="docente.sexo" required=""><option value="">-- Elige Sexo --</option>
                              <option value="Masculino">Masculino</option>
                              <option value="Femenino">Femenino</option></select>
                          </div>
                      </div>

                      </div>


                      <div class="row">
                      
                      <div  class="col-md-6">
                        <div>
                            <label>Profesion</label>
                            <select class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="docente.profesion_id" ng-options="item.id as item.nombre for item in profesiones"><option value="">-- Elige Profesion --</option></select>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="gradoAcademico">Grado Academico</label>
                          <input type="text" class="form-control" name="gradoAcademico"  placeholder="Grado Academico" ng-model="docente.gradoAcademico">
                        </div>
                      
                    </div>
                    </div>

                    <div class="row">
                      <div  class="col-md-8">
                        <div class="form-group" ng-class="{'has-error': docenteCreateForm.email.$invalid,'has-success':docenteCreateForm.email.$invalid}">
                          <label for="email">Email * </label>
                          <input type="email" class="form-control" name="email"  placeholder="Email" ng-model="docente.email" required>
                        </div>
                      </div>
                      
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': docenteCreateForm.telefono.$invalid,'has-success':docenteCreateForm.telefono.$invalid}">
                          <label for="telefono">Telefono * </label>
                          <input type="number" class="form-control" name="telefono"  placeholder="Telefono" ng-model="docente.telefono" required>
                        </div>
                      </div>

                      
                    </div>
                    
                    <div class="row">
                      <div  class="col-md-6">
                        <div class="form-group">
                          <label>Curriculum</label>
                          <input type="file" name="file" uploader-model="file" />
                        </div>
                      </div>

                      <div  class="col-md-6">
                        <div class="form-group">
                            <label>País</label>
                            <select  class="form-control ng-pristine ng-valid ng-touched" name="profesion_id" ng-model="docente.pais_id" ng-options="item.id as item.nombre for item in paises"></select>
                        </div>
                      </div>
                    </div>


                    <div class="row" ng-show="docente.pais_id==1">
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

                  <div class="box-footer" ng-show="!banderaCargando">
                    <button ng-disabled="docenteCreateForm.$invalid" type="submit" class="btn btn-primary" ng-click="uploadFile()"  >Crear</button>
                    <a ng-disabled="banderaCargando" href="/docentes" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
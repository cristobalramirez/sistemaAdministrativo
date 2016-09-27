<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            inscripciones
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/inscripciones">inscripciones</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Inscripcion</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="inscripcionEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                                            
                    <div class="row">
                    <div  class="col-md-6">
                        <div class="form-group" ng-class="{'has-error': inscripcionEditForm.fechaInscripcion.$invalid,'has-success':inscripcionEditForm.fechaInscripcion.$invalid}">
                                  <label for="fechaInscripcion">Fecha de Inscripcion</label>
                              <div  class="input-group">
                                  <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                 </div>
                                    <input  type="date" ng-change="filtroFechas()" class="form-control"  name="fechaInscripcion" ng-model="inscripcion.fechaInscripcion" required>
                              </div>
                              <label ng-show="inscripcionEditForm.fechaInscripcion.$error.required">
                            <span ng-show="inscripcionEditForm.fechaInscripcion.$error.required"><i class="fa fa-times-circle-o"></i>El campo Fecha de Inscripcion es Requerido. 
                            </span>
                          </label>
                        </div>
                      </div>

                      <div  class="col-md-6">
                        <div class="form-group" ng-class="{'has-error': inscripcionEditForm.medioPublicitario_id.$invalid,'has-success':inscripcionEditForm.medioPublicitario_id.$invalid}">
                            <label>Medio Publicitario</label>
                            <select  class="form-control ng-pristine ng-valid ng-touched" name="medioPublicitario_id" ng-model="inscripcion.medioPublicitario_id" ng-options="item.id as item.descripcion for item in medioPublicitarios" required><option value="">-- Elige Medio Publicitario --</option></select>
                            <label ng-show="inscripcionEditForm.medioPublicitario_id.$error.required">
                                <span ng-show="inscripcionEditForm.medioPublicitario_id.$error.required"><i class="fa fa-times-circle-o"></i>El campo Medio Publicitario es Requerido. 
                                </span>
                              </label>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                    <div  class="col-md-10">
                          <input  type="text" ng-model="edicionSelected" placeholder="Buscar Edicion" typeahead="atributo as atributo.descripcion + ' - '+ atributo.nombre for atributo in getService($viewValue)" typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"/>
                    </div>
                    <div  class="col-md-2">
                      <button type="submit" class="btn btn-primary" ng-click="addEdicion()">Validar</button>
                    </div>
                  </div>

                  <div class="form-group" ng-class="{'has-error': inscripcionEditForm.montoCurso.$invalid,'has-success':inscripcionEditForm.montoCurso.$invalid}">
                      <label for="montoCurso">Monto del Curso</label>
                      <input type="text" class="form-control" name="montoCurso" placeholder="Monto del Curso" ng-model="inscripcion.montoCurso" required>
                      <label ng-show="inscripcionEditForm.montoCurso.$error.required">
                        <span ng-show="inscripcionEditForm.montoCurso.$error.required"><i class="fa fa-times-circle-o"></i>El campo Monto del Curso Requerido. 
                        </span>
                      </label>
                    </div>

                    <div class="row">
                    <div  class="col-md-10">
                          <input  type="text" ng-model="personaSelected" placeholder="Buscar Persona" typeahead="atributo as atributo.nombres + ' '+ atributo.apellidos for atributo in getServicePersona($viewValue)" typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"/>
                    </div>
                    <div  class="col-md-2">
                      <button type="submit" class="btn btn-primary" ng-click="addPersona()">Validar</button>
                    </div>
                  </div>
                  <div class="form-group" ng-class="{'has-error': inscripcionEditForm.nombres.$invalid,'has-success':inscripcionEditForm.nombres.$invalid}">
                      <label for="nombres">Nombres</label>
                      <input type="text" class="form-control" name="nombres" placeholder="Nombres" ng-model="inscripcion.nombres" required>
                      <label ng-show="inscripcionEditForm.nombres.$error.required">
                        <span ng-show="inscripcionEditForm.nombres.$error.required"><i class="fa fa-times-circle-o"></i>El campo Nombres Requerido. 
                        </span>
                      </label>
                    </div>
                    <div class="form-group" ng-class="{'has-error': inscripcionEditForm.apellidos.$invalid,'has-success':inscripcionEditForm.apellidos.$invalid}">
                      <label for="apellidos">Apellidos</label>
                      <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" ng-model="inscripcion.apellidos" required>
                      <label ng-show="inscripcionEditForm.apellidos.$error.required">
                        <span ng-show="inscripcionEditForm.apellidos.$error.required"><i class="fa fa-times-circle-o"></i>El campo Apellidos Requerido. 
                        </span>
                      </label>
                    </div>
                    <div class="row">
                      <div  class="col-md-4">
                          <div class="form-group" ng-class="{'has-error': inscripcionEditForm.dni.$invalid,'has-success':inscripcionEditForm.dni.$invalid}">
                            <label for="dni">DNI</label>
                            <input type="text" class="form-control" name="dni" placeholder="DNI" ng-model="inscripcion.dni" required>
                            <label ng-show="inscripcionEditForm.dni.$error.required">
                              <span ng-show="inscripcionEditForm.dni.$error.required"><i class="fa fa-times-circle-o"></i>El campo DNI Requerido. 
                              </span>
                            </label>
                          </div>
                      </div>

                      <div  class="col-md-4">
                          <div class="form-group" ng-class="{'has-error': inscripcionEditForm.email.$invalid,'has-success':inscripcionEditForm.email.$invalid}">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Email" ng-model="inscripcion.email" required>
                            <label ng-show="inscripcionEditForm.email.$error.required">
                              <span ng-show="inscripcionEditForm.email.$error.required"><i class="fa fa-times-circle-o"></i>El campo Email Requerido. 
                              </span>
                            </label>
                          </div>
                      </div>

                      <div  class="col-md-4">
                          <div class="form-group" ng-class="{'has-error': inscripcionEditForm.telefono.$invalid,'has-success':inscripcionEditForm.telefono.$invalid}">
                            <label for="telefono">Telefono</label>
                            <input type="text" class="form-control" name="telefono" placeholder="Telefono" ng-model="inscripcion.telefono" required>
                            <label ng-show="inscripcionEditForm.telefono.$error.required">
                              <span ng-show="inscripcionEditForm.telefono.$error.required"><i class="fa fa-times-circle-o"></i>El campo Telefono Requerido. 
                              </span>
                            </label>
                          </div>
                      </div>
                    </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-disabled="inscripcionEditForm.$invalid" ng-click="updateInscripcion()">Modificar</button>
                    <a href="/inscripciones" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
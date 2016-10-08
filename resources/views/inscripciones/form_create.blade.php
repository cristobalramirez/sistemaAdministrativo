<section class="content-header">
          <h1>
            Inscripciones
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/inscripciones">Inscripciones</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Inscripcion</h3> 
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="inscripcionCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="inscripcionCreateForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                </div> 
                    
                  <div class="row">
                      <div  class="col-md-4">
                        <div class="form-group">
                            <label>Medio Publicitario</label>
                            <select  class="form-control ng-pristine ng-valid ng-touched" name="medioPublicitario_id" ng-model="inscripcion.medioPublicitario_id" ng-options="item.id as item.descripcion for item in medioPublicitarios"><option value="">-- Elige Medio Publicitario --</option></select>
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div class="form-group">
                            <label>Promocion</label>
                            <select  class="form-control ng-pristine ng-valid ng-touched" ng-click="selecionarPromocion()" name="promocion_id" ng-model="inscripcion.promocion_id" ng-options="item.id as item.descripcion for item in promociones"><option value="">-- Elige Promocion --</option></select>
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div class="form-group">
                            <label>Empleado</label>
                            <select  class="form-control ng-pristine ng-valid ng-touched" name="empleado_id" ng-model="inscripcion.empleado_id" ng-options="item.id as item.nombres+' '+item.apellidos for item in empleados"><option value="">-- Elige Medio Publicitario --</option></select>
                        </div>
                      </div>
                    </div>
                    </br>
                    <div class="row">
                    <div  class="col-md-10">
                          <input  type="text" ng-model="edicionSelected" placeholder="Buscar Edicion" typeahead="atributo as atributo.descripcion + ' - '+ atributo.nombre for atributo in getService($viewValue)" typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"/>
                    </div>
                    <div  class="col-md-2">
                      <button type="submit" class="btn btn-primary" ng-click="addEdicion()">Validar</button>
                    </div>
                  </div>
                  <div class="row">
                    <div  class="col-md-3">
                      <div class="form-group" ng-class="{'has-error': inscripcionCreateForm.montoCurso.$invalid,'has-success':inscripcionCreateForm.montoCurso.$invalid}">
                          <label for="montoCurso">Monto del Curso * </label>
                      <input type="text" ng-disabled="true" class="form-control" name="montoCurso" placeholder="Monto del Curso" ng-model="inscripcion.montoCurso" required>
                        </div>
                    </div>

                    <div  class="col-md-3">
                      <div class="form-group" ng-class="{'has-error': inscripcionCreateForm.descuentoPorcentaje.$invalid,'has-success':inscripcionCreateForm.descuentoPorcentaje.$invalid}">
                          <label for="descuentoPorcentaje">Porcentaje Descuento * </label>
                      <input type="text" ng-disabled="true" class="form-control" name="descuentoPorcentaje" placeholder="Monto del Curso" ng-model="inscripcion.descuentoPorcentaje" required>
                        </div>
                    </div>


                    <div  class="col-md-3">
                      <div class="form-group" ng-class="{'has-error': inscripcionCreateForm.descuento.$invalid,'has-success':inscripcionCreateForm.descuento.$invalid}">
                          <label for="descuento">Descuento * </label>
                      <input type="text" ng-disabled="true" class="form-control" name="descuento" placeholder="Monto del Curso" ng-model="inscripcion.descuento" required>
                        </div>
                    </div>

                    <div  class="col-md-3">
                      <div class="form-group" ng-class="{'has-error': inscripcionCreateForm.montoPagar.$invalid,'has-success':inscripcionCreateForm.montoPagar.$invalid}">
                          <label for="montoPagar">Monto a Pagar * </label>
                      <input type="text" ng-disabled="true" class="form-control" name="montoPagar" placeholder="Monto del Curso" ng-model="inscripcion.montoPagar" required>
                        </div>
                    </div>
                  </div>
                  </br>
                    <div class="row">
                    <div  class="col-md-10">
                          <input  type="text" ng-model="personaSelected" placeholder="Buscar Persona" typeahead="atributo as atributo.nombres + ' '+ atributo.apellidos for atributo in getServicePersona($viewValue)" typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"/>
                    </div>
                    <div  class="col-md-2">
                      <button type="submit" class="btn btn-primary" ng-click="addPersona()">Validar</button>
                    </div>
                  </div>
                  <div class="form-group" ng-class="{'has-error': inscripcionCreateForm.nombres.$invalid,'has-success':inscripcionCreateForm.nombres.$invalid}">
                      <label for="nombres">Nombres * </label>
                      <input type="text" class="form-control" name="nombres" placeholder="Nombres" ng-model="inscripcion.nombres" required>
                    </div>
                    <div class="form-group" ng-class="{'has-error': inscripcionCreateForm.apellidos.$invalid,'has-success':inscripcionCreateForm.apellidos.$invalid}">
                      <label for="apellidos">Apellidos * </label>
                      <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" ng-model="inscripcion.apellidos" required>
                    </div>
                    <div class="row">
                      <div  class="col-md-4">
                          <div class="form-group" ng-class="{'has-error': inscripcionCreateForm.dni.$invalid,'has-success':inscripcionCreateForm.dni.$invalid}">
                            <label for="dni">DNI * </label>
                            <input type="text" class="form-control" name="dni" placeholder="DNI" ng-model="inscripcion.dni" required>
                          </div>
                      </div>

                      <div  class="col-md-4">
                          <div class="form-group" ng-class="{'has-error': inscripcionCreateForm.email.$invalid,'has-success':inscripcionCreateForm.email.$invalid}">
                            <label for="email">Email * </label>
                            <input type="text" class="form-control" name="email" placeholder="Email" ng-model="inscripcion.email" required>
                          </div>
                      </div>

                      <div  class="col-md-4">
                          <div class="form-group" ng-class="{'has-error': inscripcionCreateForm.telefono.$invalid,'has-success':inscripcionCreateForm.telefono.$invalid}">
                            <label for="telefono">Telefono * </label>
                            <input type="text" class="form-control" name="telefono" placeholder="Telefono" ng-model="inscripcion.telefono" required>
                          </div>
                      </div>
                    </div>


                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" ng-disabled="inscripcionCreateForm.$invalid" class="btn btn-primary" ng-click="createInscripcion()">Crear</button>
                    <a href="/inscripciones" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
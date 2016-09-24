<section class="content-header">
          <h1>
            Personas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/personas">Personas</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Persona</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="personaCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors"> 
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                   <div class="form-group" ng-class="{'has-error': personaCreateForm.nombres.$invalid,'has-success':personaCreateForm.nombres.$invalid}">
                      <label for="nombres">Nombres</label>
                      <input type="text" class="form-control" name="nombres"  placeholder="Nombres" ng-model="persona.nombres" required>
                      <label ng-show="personaCreateForm.nombres.$error.required">
                        <span ng-show="personaCreateForm.nombres.$error.required"><i class="fa fa-times-circle-o"></i>El campo Nombres es Requerido. 
                        </span>
                      </label>
                    </div>

                    <div class="form-group" ng-class="{'has-error': personaCreateForm.apellidos.$invalid,'has-success':personaCreateForm.apellidos.$invalid}">
                      <label for="apellidos">Apellidos</label>
                      <input type="text" class="form-control" name="apellidos"  placeholder="Apellidos" ng-model="persona.apellidos" required>
                      <label ng-show="personaCreateForm.apellidos.$error.required">
                        <span ng-show="personaCreateForm.apellidos.$error.required"><i class="fa fa-times-circle-o"></i>El campo Apellidos es Requerido. 
                        </span>
                      </label>
                    </div>
                    
                    <div class="row">
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': personaCreateForm.dni.$invalid,'has-success':personaCreateForm.dni.$invalid}">
                          <label for="dni">DNI</label>
                          <input ng-blur="validaDni(persona.dni)" type="text" class="form-control" name="dni"  placeholder="DNI" ng-model="persona.dni" required>
                          <label ng-show="personaCreateForm.dni.$error.required">
                            <span ng-show="personaCreateForm.dni.$error.required"><i class="fa fa-times-circle-o"></i>El campo DNI es Requerido. 
                            </span>
                          </label>
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': personaCreateForm.fechaNacimiento.$invalid,'has-success':personaCreateForm.fechaNacimiento.$invalid}">
                                  <label for="fechaNacimiento">Fecha de Nacimiento</label>
                              <div  class="input-group">
                                  <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                 </div>
                                    <input  type="date" ng-change="filtroFechas()" class="form-control"  name="fechaNacimiento" ng-model="persona.fechaNac" required>
                              </div>
                              <label ng-show="personaCreateForm.fechaNacimiento.$error.required">
                            <span ng-show="personaCreateForm.fechaNacimiento.$error.required"><i class="fa fa-times-circle-o"></i>El campo Fecha de Nacimiento es Requerido. 
                            </span>
                          </label>
                        </div>
                      </div>

                    <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': personaCreateForm.sexo.$invalid,'has-success':personaCreateForm.sexo.$invalid}">
                              <label>Sexo</label>
                              <select class="form-control ng-pristine ng-valid ng-touched" name="sexo" ng-model="persona.sexo" required><option value="">-- Elige Sexo --</option>
                              <option value="Masculino">Masculino</option>
                              <option value="Femenino">Femenino</option></select>
                              <label ng-show="personaCreateForm.sexo.$error.required">
                            <span ng-show="personaCreateForm.sexo.$error.required"><i class="fa fa-times-circle-o"></i>El campo Sexo es Requerido. 
                            </span>
                          </label>
                          </div>
                      </div>

                      </div>


                      <div class="row">
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': personaCreateForm.estadoCivil.$invalid,'has-success':personaCreateForm.estadoCivil.$invalid}">
                              <label>Estado Civil</label>
                              <select class="form-control ng-pristine ng-valid ng-touched" name="estadoCivil" ng-model="persona.estadoCivil" required><option value="">-- Elige Estado Civil --</option>
                                <option value="Masculino">SOLTERO</option>
                                <option value="Femenino">CASADO</option>
                                <option value="Femenino">CONVIVIENTE</option>
                                <option value="Femenino">VIUDO</option>
                                <option value="Femenino">DIVORCIADO</option>
                              </select>
                              <label ng-show="personaCreateForm.estadoCivil.$error.required">
                                <span ng-show="personaCreateForm.estadoCivil.$error.required"><i class="fa fa-times-circle-o"></i>El campo Estado Civil es Requerido. 
                                </span>
                              </label>
                          </div>
                      </div>
                      
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{'has-error': personaCreateForm.profesion_id.$invalid,'has-success':personaCreateForm.profesion_id.$invalid}">
                            <label>Profesion</label>
                            <select ng-click="cargarDistrito()" class="form-control ng-pristine ng-valid ng-touched" name="profesion_id" ng-model="persona.profesion_id" ng-options="item.id as item.nombre for item in profesiones" required><option value="">-- Elige Profesion --</option></select>
                            <label ng-show="personaCreateForm.profesion_id.$error.required">
                                <span ng-show="personaCreateForm.profesion_id.$error.required"><i class="fa fa-times-circle-o"></i>El campo Profesion es Requerido. 
                                </span>
                              </label>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <label for="descripcionProfesion">Descipcion Profesion</label>
                        <input type="text" class="form-control" name="Ciclo Academico" placeholder="Descipcion Profesion" ng-disabled="persona.profesion_id!=1" ng-model="persona.descripcionProfesio">
                      </div>
                      
                    </div>

                    <div class="row">
                      <div  class="col-md-8">
                        <div class="form-group" ng-class="{true: 'has-error'}[ personaCreateForm.email.$error.required && personaCreateForm.$submitted || personaCreateForm.z.$dirty && personaCreateForm.email.$invalid]">
                          <label for="email">Email</label>
                          <input type="text" class="form-control" name="email"  placeholder="Email" ng-model="persona.email" required>
                          <label ng-show="personaCreateForm.$submitted || personaCreateForm.email.$dirty && personaCreateForm.email.$invalid">
                            <span ng-show="personaCreateForm.email.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                        </div>
                      </div>
                      
                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{true: 'has-error'}[ personaCreateForm.telefono.$error.required && personaCreateForm.$submitted || personaCreateForm.z.$dirty && personaCreateForm.telefono.$invalid]">
                          <label for="telefono">Telefono</label>
                          <input type="text" class="form-control" name="telefono"  placeholder="Telefono" ng-model="persona.telefono" required>
                          <label ng-show="personaCreateForm.$submitted || personaCreateForm.telefono.$dirty && personaCreateForm.telefono.$invalid">
                            <span ng-show="personaCreateForm.telefono.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                        </div>
                      </div>

                      
                    </div>
                    
                    <div class="form-group" ng-class="{true: 'has-error'}[ personaCreateForm.institucionTrabajo.$error.required && personaCreateForm.$submitted || personaCreateForm.z.$dirty && personaCreateForm.institucionTrabajo.$invalid]">
                      <label for="institucionTrabajo">Institucion de Trabajo</label>
                      <input type="text" class="form-control" name="institucionTrabajo"  placeholder="Institucion de Trabajo" ng-model="persona.institucionTrabajo" required>
                      <label ng-show="personaCreateForm.$submitted || personaCreateForm.institucionTrabajo.$dirty && personaCreateForm.institucionTrabajo.$invalid">
                        <span ng-show="personaCreateForm.institucionTrabajo.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>


                    <div class="row">
                      <div  class="col-md-4">
                        <div>
                            <label>Departamento</label>
                            <select ng-click="TrabajoCargarProvincia()" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="TrabajoDepertamentoSelect" ng-options="item.departamento as item.departamento for item in TrabajoDepartamentos"><option value="">-- Elige Departamento --</option></select>
                        </div>
                      </div>
                      
                      <div  class="col-md-4">
                        <div>
                            <label>Provinca</label>
                            <select ng-disabled="TrabajoDepertamentoSelect==null" ng-click="TrabajoCargarDistrito()" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="TrabajoProvinciaSelect" ng-options="item.provincia as item.provincia for item in TrabajoProvincias"><option value="">-- Elige Provincia --</option></select>
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div>
                            <label>Distrito</label>
                            <select ng-disabled="TrabajoDepertamentoSelect==null || TrabajoProvinciaSelect==undefined" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="TrabajoDistritoSelect" ng-options="item.id as item.distrito for item in TrabajoDistritos"><option value="">-- Elige Distrito --</option></select>
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group" ng-class="{true: 'has-error'}[ personaCreateForm.direccion.$error.required && personaCreateForm.$submitted || personaCreateForm.z.$dirty && personaCreateForm.direccion.$invalid]">
                      <label for="direccion">Domicilio</label>
                      <input type="text" class="form-control" name="direccion"  placeholder="Domicilio" ng-model="persona.direccion" required>
                      <label ng-show="personaCreateForm.$submitted || personaCreateForm.direccion.$dirty && personaCreateForm.direccion.$invalid">
                        <span ng-show="personaCreateForm.direccion.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>


                    <div class="row">
                      <div  class="col-md-4">
                        <div>
                            <label>Departamento</label>
                            <select ng-click="DomicilioCargarProvincia()" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="DomicilioDepertamentoSelect" ng-options="item.departamento as item.departamento for item in DomicilioDepartamentos"><option value="">-- Elige Departamento --</option></select>
                        </div>
                      </div>
                      
                      <div  class="col-md-4">
                        <div>
                            <label>Provinca</label>
                            <select ng-disabled="DomicilioDepertamentoSelect==null" ng-click="DomicilioCargarDistrito()" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="DomicilioProvinciaSelect" ng-options="item.provincia as item.provincia for item in DomicilioProvincias"><option value="">-- Elige Provincia --</option></select>
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div>
                            <label>Distrito</label>
                            <select ng-disabled="DomicilioDepertamentoSelect==null || DomicilioProvinciaSelect==undefined" class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="DomicilioDistritoSelect" ng-options="item.id as item.distrito for item in DomicilioDistritos"><option value="">-- Elige Distrito --</option></select>
                        </div>
                      </div>
                    </div>


                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createPersona()">Crear</button>
                    <a href="/personas" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
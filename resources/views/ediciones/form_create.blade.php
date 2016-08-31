<section class="content-header">
          <h1>
            Ediciones
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/ediciones">Ediciones</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Edicion</h3> 
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="edicionCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>



                  <div class="row">
                    <div  class="col-md-4">
                        <div  class="form-group">
                                  <label for="fechaInicio">Fecha de Inicio</label>
                              <div  class="input-group">
                                  <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                 </div>
                                    <input  type="date" ng-change="filtroFechas()" class="form-control"  name="fechaInicio" ng-model="edicion.fechaInicio">
                              </div>
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div  class="form-group">
                                  <label for="fechaFin">Fecha de Fin</label>
                              <div  class="input-group">
                                  <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                 </div>
                                    <input  type="date" ng-change="filtroFechas()" class="form-control"  name="fechaFin" ng-model="edicion.fechaFin">
                              </div>
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div class="form-group" ng-class="{true: 'has-error'}[ edicionCreateForm.costoCurso.$error.required && edicionCreateForm.$submitted || edicionCreateForm.z.$dirty && edicionCreateForm.costoCurso.$invalid]">
                          <label for="costoCurso">Costo del Curso</label>
                          <input ng-blur="validaDni(edicion.costoCurso)" type="text" class="form-control" name="costoCurso"  placeholder="Costo del Curso" ng-model="edicion.costoCurso" required>
                          <label ng-show="edicionCreateForm.$submitted || edicionCreateForm.costoCurso.$dirty && edicionCreateForm.costoCurso.$invalid">
                            <span ng-show="edicionCreateForm.costoCurso.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                        </div>
                      </div>
                  </div>


                  <div class="row">
                    <div  class="col-md-4">
                        <div>
                            <label>Cursos</label>
                            <select class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="edicion.curso_id" ng-options="item.id as item.descripcion for item in cursos"><option value="">-- Elige Cursos --</option></select>
                        </div>
                      </div>
                    <div  class="col-md-4">
                        <div>
                              <label>Modalidad</label>
                              <select class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="edicion.modalidad"><option value="">-- Elige Modalidad --</option>
                              <option value="Presencial">Presencial</option>
                              <option value="Semi-Presencial">Semi-Presencial</option>
                              <option value="Tele-Presencial">Tele-Presencial</option></select>
                          </div>
                      </div>
                      <div  class="col-md-4">
                        <div>
                            <label>Acreditadora</label>
                            <select class="form-control ng-pristine ng-valid ng-touched" name="" ng-model="edicion.acreditadora_id" ng-options="item.id as item.nombre for item in acreditadoras"><option value="">-- Elige Acreditadora --</option></select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div  class="col-md-4">
                        <div class="form-group">
                          <label>Brochure</label>
                          <input type="file" name="fileBrochure" uploader-model="fileBrochure" />
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div class="form-group">
                          <label>Resolucion</label>
                          <input type="file" name="fileResolucion" uploader-model="fileResolucion" />
                        </div>
                      </div>
                      <div  class="col-md-4">
                        <div class="form-group">
                          <label>Proyecto</label>
                          <input type="file" name="fileProyecto" uploader-model="fileProyecto" />
                        </div>
                      </div>
                  </div>

                  <div class="row">
                    

                      <div  class="col-md-4">
                        <div class="form-group">
                          <label>Publicidad Face</label>
                          <input type="file" name="filePublicidadFace" uploader-model="filePublicidadFace" />
                        </div>
                      </div>

                      <div  class="col-md-4">
                        <div class="form-group">
                          <label>Publicidad Imprimir</label>
                          <input type="file" name="filePublicidadImprimir" uploader-model="filePublicidadImprimir" />
                        </div>
                      </div>
                  </div>
                     
                    

                    <div class="box box-secondary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Docente</h3> 
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div  class="col-md-10">
                          <input  type="text" ng-model="docenteSelected" placeholder="Buscar Docente" typeahead="atributo as atributo.nombres+' '+atributo.apellidos for atributo in getService($viewValue)" typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"/>
                    </div>
                    <div  class="col-md-2">
                      <button type="submit" class="btn btn-primary" ng-click="addDocente()">Agregar</button>
                    </div>
                  </div>
                  <div class="form-group">
                    <table class="table table-bordered">
                                  <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Sexo</th>
                                    <th style="width: 40px">Eliminar</th>
                                  </tr>
                    
                                  <tr ng-repeat="row in docentesAdd">
                                    <td>@{{$index + 1}}</td>
                                    <td>@{{row.nombres}}</td>
                                    <td>@{{row.apellidos}}</td>
                                    <td>@{{row.sexo}}</td>
                                    <td><a ng-click="destroyDocente($index)" class="btn btn-danger btn-xs" >Eliminar</a></td>
                                  </tr>              
                                </table>
                  </div>
                  </div>
                  </div>


                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="uploadFile()">Crear</button>
                    <a href="/ediciones" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
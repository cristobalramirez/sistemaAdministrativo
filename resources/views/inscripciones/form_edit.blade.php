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
                  <div class="callout callout-danger" ng-show="inscripcionEditForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                </div> 
                <div class="row">
                  <div  class="col-md-6">
                    <h3>Datos Del cliente</h3>
                  <div>
                    <label>Cliente : @{{inscripcion.nombres+' '+inscripcion.apellidos }}</label>
                  </div>
                  <div>
                    <label>DNI : @{{inscripcion.dni}}</label>
                  </div>
                  <div>
                    <label>Email : @{{inscripcion.email}}</label>
                  </div>
                  <div>
                    <label>Telefono : @{{inscripcion.telefono}}</label>
                  </div>
                  </div>

                  <div  class="col-md-6">
                  <h3>Datos De la inscripcion</h3>
                  <div>
                    <label>Edicion : @{{inscripcion.nombreCurso}}</label>
                  </div>
                  <div>
                    <label>Promocion : @{{inscripcion.nombrePromocion}}</label>
                  </div>
                  <div>
                    <label>Promocion : @{{inscripcion.descripcion_promocion}}</label>
                  </div>
                  <div>
                    <label>Costo Curso : @{{inscripcion.montoCurso}}</label>
                  </div>
                  <div>
                    <label>Descuento : @{{inscripcion.descuento}}</label>
                  </div>
                  <div>
                    <label>Monto Pagar : @{{inscripcion.montoPagar}}</label>
                  </div>
                  <div>
                    <label>Medio Publicitario : @{{inscripcion.nombreMedio}}</label>
                  </div>
                  </div>


                  </div>
                  <div class="row">

                      <div  class="col-md-4">
                        <div class="form-group">
                            <label>Promocion</label>
                            <select  class="form-control ng-pristine ng-valid ng-touched" ng-click="selecionarPromocion()" name="promocion_id" ng-model="inscripcion.promocion_id" ng-options="item.id as item.descripcion for item in promociones"></select>
                        </div>
                      </div>
                      <div  class="col-md-8">
                          <label for="descripcion_promocion">Descripcion Promocion </label>
                          <input type="text" class="form-control" name="descripcion_promocion" placeholder="Descripcion Promocion" ng-model="inscripcion.descripcion_promocion">
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
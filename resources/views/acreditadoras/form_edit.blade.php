<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Acreditadoras
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/acreditadoras">Acreditadoras</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Acreditadora</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="acreditadoraEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="acreditadoraEditForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                    </div>
                   <div class="form-group" ng-class="{'has-error': acreditadoraEditForm.nombre.$invalid,'has-success':acreditadoraEditForm.nombre.$invalid}">
                      <label for="nombre">Nombre *</label>
                      <input type="text" class="form-control" name="nombre" ng-blur="validanomUbigeo(acreditadora.nombre)" placeholder="Nombre" ng-model="acreditadora.nombre" required>
                      
                    </div>

                    <div class="form-group" ng-class="{'has-error': acreditadoraEditForm.departamento.$invalid,'has-success':acreditadoraEditForm.departamento.$invalid}">
                        <label>Departamento *</label>
                        <select ng-click="cargarProvincia()" class="form-control ng-pristine ng-valid ng-touched" name="departamento" ng-model="depertamentoSelect" ng-options="item.departamento as item.departamento for item in departamentos" required><option value="">-- Elige Departamento --</option></select>
                        </div>
 
                    <div class="form-group" ng-class="{'has-error': acreditadoraEditForm.provincia.$invalid,'has-success':acreditadoraEditForm.provincia.$invalid}">
                        <label>Provinca *</label>
                        <select ng-disabled="depertamentoSelect==null" ng-click="cargarDistrito()" class="form-control ng-pristine ng-valid ng-touched" name="provincia" ng-model="provinciaSelect" ng-options="item.provincia as item.provincia for item in provincias" required><option value="">-- Elige Provincia --</option></select>
                        </div>

                    <div class="form-group" ng-class="{'has-error': acreditadoraEditForm.distrito.$invalid,'has-success':acreditadoraEditForm.distrito.$invalid}">
                        <label>Distrito *</label>
                        <select ng-disabled="depertamentoSelect==null || provinciaSelect==undefined" ng-click="selectPlan1()" class="form-control ng-pristine ng-valid ng-touched" name="distrito" ng-model="distritoSelect" ng-options="item.id as item.distrito for item in distritos" required><option value="">-- Elige Distrito --</option></select>
                        </div>
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-disabled="acreditadoraEditForm.$invalid" ng-click="updateAcreditadora()">Modificar</button>
                    <a href="/acreditadoras" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
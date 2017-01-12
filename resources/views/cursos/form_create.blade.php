<section class="content-header">
          <h1>
            Cursos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/cursos">Cursos</a></li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Curso</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="cursoCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="cursoCreateForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                </div>

                    
                   <div class="form-group" ng-class="{'has-error': cursoCreateForm.descripcion.$invalid,'has-success':cursoCreateForm.descripcion.$invalid}">
                      <label for="descripcion">Cursos * </label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Cursos" ng-model="curso.descripcion" required>
                    </div>

                    <div class="form-group" ng-class="{'has-error': cursoCreateForm.abreviatura.$invalid,'has-success':cursoCreateForm.abreviatura.$invalid}">
                      <label for="abreviatura">Abreviatura * </label>
                      <input type="text" class="form-control" name="abreviatura" placeholder="Abreviatura" ng-model="curso.abreviatura" required>
                    </div>

                    <div class="form-group" ng-class="{'has-error': cursoCreateForm.categoria_id.$invalid,'has-success':cursoCreateForm.categoria_id.$invalid}">
                            <label>Categoria * </label>
                            <select class="form-control ng-pristine ng-valid ng-touched" name="categoria_id" ng-model="curso.categoria_id" ng-options="item.id as item.nombreCategoria for item in categorias" required><option value="">-- Elige Categoria --</option></select>
                            </div>


                    

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" ng-disabled="cursoCreateForm.$invalid" class="btn btn-primary" ng-click="createCurso()">Crear</button>
                    <a href="/cursos" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
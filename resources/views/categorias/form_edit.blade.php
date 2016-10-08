<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Categorias
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/categorias">Categorias</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Categoria</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="categoriaEditForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="categoriaEditForm.$invalid">
                          <strong >Los campos(*) son requeridos</strong>
                    </div>
                    
                   <div class="form-group" ng-class="{'has-error': categoriaEditForm.nombreCategoria.$invalid,'has-success':categoriaEditForm.nombreCategoria.$invalid}">
                      <label for="nombreCategoria">Nombre * </label>
                      <input type="text" class="form-control" name="nombreCategoria" placeholder="Nombre" ng-model="categoria.nombreCategoria" required>
                     
                    </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-disabled="categoriaEditForm.$invalid" ng-click="updateCategoria()">Modificar</button>
                    <a href="/categorias" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
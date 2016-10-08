<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Categoria;

class CategoriaRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Categoria;
    }

    public function search($q)
    {
        $cursos =Categoria::where('descripcion','like', $q.'%')
                    ->paginate(15);
        return $cursos;
    }
    public function all()
    {
        $cursos =Categoria::get();
        return $cursos;
    }
     public function cargarCategorias(){
        $cursos = Categoria::get();
        return $cursos;
    }
} 
<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Curso;

class CursoRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Curso;
    }

    public function search($q)
    {
        $cursos =Curso::where('descripcion','like', $q.'%')
                    ->paginate(15);
        return $cursos;
    }
    public function all()
    {
        $curos =Curso::get();
        return $curos;
    }
} 
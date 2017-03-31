<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Especialidad;

class EspecialidadRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Especialidad;
    }

    public function search($q)
    {
        $especialidad =Especialidad::where('descripcion','like', $q.'%')
                    ->paginate(15);
        return $especialidad;
    }
    public function CargarEspecialidad(){
        $especialidad = Especialidad::orderBy('descripcion', 'asc')
                    ->get();
        return $especialidad;
    }
} 
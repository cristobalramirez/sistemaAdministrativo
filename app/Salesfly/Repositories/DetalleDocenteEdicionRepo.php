<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\DetalleDocenteEdicion;

class DetalleDocenteEdicionRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new DetalleDocenteEdicion;
    }

    public function search($q)
    {
        $detDocenteEdicion =DetalleDocenteEdicion::where('edicion_id','=', $q)
        			->leftjoin('docentes','detalleDocenteEdicion.docente_id','=','docentes.id')
        			->select('detalleDocenteEdicion.*','docentes.nombres','docentes.apellidos','docentes.sexo')
                    ->get();
        return $detDocenteEdicion;
    }

  
} 
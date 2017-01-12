<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\SeguimientoInscripcion;

class SeguimientoInscripcionRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new SeguimientoInscripcion;
    }

    public function seguimientos($id)
    {
        $seguimientoInscripcion =SeguimientoInscripcion::where('inscripcion_id','=',$id)
        			->orderBy('id', 'desc')
                    ->get();
        return $seguimientoInscripcion;
    }
} 
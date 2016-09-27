<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Inscripcion;

class InscripcionRepo extends BaseRepo{
    public function getModel()
    {
        return new Inscripcion;
    }

    public function search($q)
    {
        $inscripciones =Inscripcion::where('dni','like', $q.'%')
                    ->orWhere('nombres','like',$q.'%')
                    ->paginate(15);
        return $inscripciones;
    }
    public function paginaterepo($c){
         $inscripciones =Inscripcion::leftjoin('ediciones','inscripciones.edicion_id','=','ediciones.id')
                    ->leftjoin('cursos','ediciones.curso_id','=','cursos.id')
                    ->select('inscripciones.*','cursos.descripcion as curso')
                    ->paginate($c);
        return $inscripciones;
    }
} 
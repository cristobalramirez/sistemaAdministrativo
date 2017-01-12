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
        $inscripciones =Inscripcion::with('persona')
                    ->with('edicion.curso')
                    ->where('dni','like', $q.'%')
                    ->orWhere('nombres','like',$q.'%')
                    ->paginate(15);
        return $inscripciones;
    }
    public function searchCurso($curso,$edicion,$fecha)
    {
        if ($curso==0) {
            $inscripciones =Inscripcion::with('persona')
                    ->with('edicion.curso')
                    ->leftjoin('ediciones','inscripciones.edicion_id','=','ediciones.id')
                    ->leftjoin('cursos','ediciones.curso_id','=','cursos.id')
                    ->select('inscripciones.*','cursos.descripcion as curso')
                    ->paginate(15);
        }else if($edicion==0){
            $inscripciones =Inscripcion::with('persona')
                    ->with('edicion.curso')
                    ->leftjoin('ediciones','inscripciones.edicion_id','=','ediciones.id')
                    ->leftjoin('cursos','ediciones.curso_id','=','cursos.id')
                    ->select('inscripciones.*','cursos.descripcion as curso')
                    ->where('cursos.id','=', $curso)
                    //->where('ediciones.id','=',$edicion)
                    ->paginate(15);
        }else if($fecha==0){
            $inscripciones =Inscripcion::with('persona')
                    ->with('edicion.curso')
                    ->leftjoin('ediciones','inscripciones.edicion_id','=','ediciones.id')
                    ->leftjoin('cursos','ediciones.curso_id','=','cursos.id')
                    ->select('inscripciones.*','cursos.descripcion as curso')
                    ->where('cursos.id','=', $curso)
                    ->where('ediciones.id','=',$edicion)
                    ->paginate(15);
        }else{
          $inscripciones =Inscripcion::with('persona')
                    ->with('edicion.curso')
                    ->leftjoin('ediciones','inscripciones.edicion_id','=','ediciones.id')
                    ->leftjoin('cursos','ediciones.curso_id','=','cursos.id')
                    ->leftjoin('seguimientoInscripciones','seguimientoInscripciones.inscripcion_id','=','inscripciones.id')
                    ->select('inscripciones.*','cursos.descripcion as curso')
                    ->where('cursos.id','=', $curso)
                    ->where('ediciones.id','=',$edicion)
                    ->where('seguimientoInscripciones.fechaCompromiso','like',$fecha.'%')
                    ->paginate(15);  
        }
        
        return $inscripciones;
    }
    public function paginaterepo($c){
         $inscripciones =Inscripcion::with('persona')
                    ->with('edicion.curso')
                    ->leftjoin('ediciones','inscripciones.edicion_id','=','ediciones.id')
                    ->leftjoin('cursos','ediciones.curso_id','=','cursos.id')
                    ->select('inscripciones.*','cursos.descripcion as curso')
                    ->paginate($c);
        return $inscripciones;
    }
    public function buscarInscripcion($d,$p){
        $inscripciones =Inscripcion::with('persona')
                    ->with('edicion.curso')
                    ->where('edicion_id','=', $d)
                    ->where('persona_id','=', $p)
                    ->get();
        return $inscripciones;
    } 
    
} 
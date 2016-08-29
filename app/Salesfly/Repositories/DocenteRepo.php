<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Docente;

class DocenteRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Docente;
    }

    public function search($q)
    {
        $docentes =Docente::where('nombres','like', $q.'%')
                    ->orwhere('apellidos','like', $q.'%')
                    ->orwhere('dni','like', $q.'%')
                    ->orwhere('email','like', $q.'%')
                    ->orwhere('telefono','like', $q.'%')
                    ->paginate(15);
        return $docentes;
    }
    public function paginaterepo($c){
        $docentes = Docente::leftjoin('ubigeos','docentes.ubigeo_id','=','ubigeos.id')
                    ->select('docentes.*','ubigeos.departamento as departamento')
                    ->paginate($c);
        return $docentes;
    }
    public function validarDni($text){
        $persona =Docente::where('dni','=', $text)
                    ->first();
        return $persona;
    }
    public function buscarDocente($q){
      $datos = Docente::where('nombres','like',$q.'%')
                        ->orwhere('apellidos','like',$q.'%') 
                        ->orwhere('dni','like',$q.'%')                
                            ->get();
            return $datos;
    }
} 
<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Persona;

class PersonaRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Persona;
    }

    public function search($q)
    {
        $personas =Persona::where('nombres','like', $q.'%')
                    ->orwhere('apellidos','like', '%'.$q.'%')
                    ->orwhere('dni','like', $q.'%')
                    ->orwhere('email','like', $q.'%')
                    ->orwhere('telefono','like', $q.'%')
                    ->paginate(15);
        return $personas;
    }
    public function paginaterepo($c){
        $personas = Persona::leftjoin('ubigeos','personas.ubigeoTrabajo_id','=','ubigeos.id')
                    ->select('personas.*','ubigeos.departamento as departamento')
                    ->paginate($c);
        return $personas;
    }
    public function validarDni($text){
        $persona =Persona::where('dni','=', $text)
                    ->first();
        return $persona;
    }
    public function buscarPersona($q){
      $persona = Persona::where('nombres','like',$q.'%')
                        ->orwhere('apellidos','like',$q.'%') 
                        ->orwhere('dni','like',$q.'%')                
                            ->get();
            return $persona;
    }
    public function buscarPersonaConDni($q){
      $persona = Persona::where('dni','=',$q)              
                        ->get();
            return $persona;
    }
} 
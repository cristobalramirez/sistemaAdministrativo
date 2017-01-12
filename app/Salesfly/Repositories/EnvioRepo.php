<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Envio;

class EnvioRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Envio;
    }
    public function envioInscripcion($id){
        $envio = Envio::where('inscripcion_id','=', $id)
                    ->get();
        return $envio;
    }
    
} 
<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Agencia;

class AgenciaRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Agencia;
    }

    public function search($q)
    {
        $agencia =Agencia::where('nombre','like', $q.'%')
                    ->paginate(15);
        return $agencia;
    }
     public function cargarAgencias(){
        $agencia = Agencia::get();
        return $agencia;
    }
} 
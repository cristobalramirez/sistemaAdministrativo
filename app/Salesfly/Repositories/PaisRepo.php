<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Pais;

class PaisRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Pais;
    }

    public function search($q)
    {
        $paises =Pais::where('nombre','like', $q.'%')
                    ->paginate(15);
        return $paises;
    }
    public function CargarPaises(){
        $paises = Pais::orderBy('nombre', 'asc')
                    ->get();
        return $paises;
    }
} 
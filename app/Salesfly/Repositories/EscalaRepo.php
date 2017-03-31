<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Escala;

class EscalaRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Escala;
    }

    public function search($q)
    {
        $escala =Escala::where('descripcion','like', $q.'%')
                    ->paginate(15);
        return $escala;
    }
    public function CargarEscala(){
        $escala = Escala::orderBy('descripcion', 'asc')
                    ->get();
        return $escala;
    }
} 
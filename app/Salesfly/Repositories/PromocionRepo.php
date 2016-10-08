<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Promocion;

class PromocionRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new Promocion;
    }

    public function search($q)
    {
        $promociones =Promocion::where('descripcion','like', $q.'%')
                    ->paginate(15);
        return $promociones;
    }
    public function cargarPromociones(){
        $promociones = Promocion::get();
        return $promociones;
    }
} 
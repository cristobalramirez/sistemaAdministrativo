<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\TipoGasto;

class TipoGastoRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new TipoGasto;
    }

    public function search($q)
    {
        $paises =TipoGasto::where('descripcion','like', $q.'%')
                    ->paginate(15);
        return $paises;
    }
} 
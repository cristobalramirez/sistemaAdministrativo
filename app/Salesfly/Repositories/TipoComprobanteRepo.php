<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\TipoComprobante;

class TipoComprobanteRepo extends BaseRepo{
    
    public function getModel()
    { 
        return new TipoComprobante;
    }

    public function search($q)
    {
        $paises =TipoComprobante::where('descripcion','like', $q.'%')
                    ->paginate(15);
        return $paises;
    }
} 
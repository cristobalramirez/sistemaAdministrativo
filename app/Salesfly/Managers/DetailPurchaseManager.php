<?php
namespace Salesfly\Salesfly\Managers;
class DetailPurchaseManager extends BaseManager {

    public function getRules()
    {
        $rules = ['descuento'=> '',
        			'montoBruto'=>'',
        			'montoTotal'=>'',
        			'variants_id'=>'',
        			'purchases_id'=>'',
                    'preProducto'=>'',
                    'preCompra'=>'',
                    'cantidad'=>''
       				 ];
        return $rules;
    }
}
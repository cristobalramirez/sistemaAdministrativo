<?php
namespace Salesfly\Salesfly\Managers;
class DetailPurchaseManager extends BaseManager {

    public function getRules()
    {
        $rules = ['producto'=>'',
                   'descuento'=> '',
        			'montoBruto'=>'',
        			'montoTotal'=>'',
        			'detPres_id'=>'',
        			'purchases_id'=>'',
                    'preProducto'=>'',
                    'preCompra'=>'',
                    'cantidad'=>''
       				 ];
        return $rules;
    }
}
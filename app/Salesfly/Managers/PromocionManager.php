<?php
namespace Salesfly\Salesfly\Managers;
class PromocionManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'descripcion'=> 'required',
            'porcentajeDescuento'=> 'required'
                  ];
        return $rules;
    }}
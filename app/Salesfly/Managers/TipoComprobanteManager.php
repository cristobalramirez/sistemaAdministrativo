<?php
namespace Salesfly\Salesfly\Managers;
class TipoComprobanteManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'descripcion'=> 'required',
            'numero'=> '',
            'estado'=> ''
                  ];
        return $rules;
    }}
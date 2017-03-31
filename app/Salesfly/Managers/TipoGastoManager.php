<?php
namespace Salesfly\Salesfly\Managers;
class TipoGastoManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'descripcion'=> 'required',
            'tipo'=> 'required',
            'estado'=> ''
                  ];
        return $rules;
    }}
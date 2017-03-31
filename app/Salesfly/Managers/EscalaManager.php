<?php
namespace Salesfly\Salesfly\Managers;
class EscalaManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'descripcion'=> 'required',
            'glosa'=> '',
            'estado'=> ''
                  ];
        return $rules;
    }}
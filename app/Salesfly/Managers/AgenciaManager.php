<?php
namespace Salesfly\Salesfly\Managers;
class AgenciaManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'nombre'=> '',
            'descripcion'=> ''
                  ];
        return $rules;
    }}
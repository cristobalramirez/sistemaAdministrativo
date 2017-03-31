<?php
namespace Salesfly\Salesfly\Managers;
class EspecialidadManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'descripcion'=> 'required',
            'glosa'=> '',
            'estado'=> ''
                  ];
        return $rules;
    }}
<?php
namespace Salesfly\Salesfly\Managers;
class PaisManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'nombre'=> 'required'
                  ];
        return $rules;
    }}
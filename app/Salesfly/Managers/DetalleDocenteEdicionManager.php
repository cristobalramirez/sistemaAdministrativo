<?php
namespace Salesfly\Salesfly\Managers;
class DetalleDocenteEdicionManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'curso_id'=> 'required',
            'edicion_id'=> 'required'
                  ];
        return $rules;
    }}
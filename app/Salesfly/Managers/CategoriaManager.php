<?php
namespace Salesfly\Salesfly\Managers;
class CategoriaManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'nombreCategoria'=> '',
            'descripcion'=> ''
                  ];
        return $rules;
    }}
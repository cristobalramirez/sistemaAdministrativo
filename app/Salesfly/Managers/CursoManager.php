<?php
namespace Salesfly\Salesfly\Managers;
class CursoManager extends BaseManager {

    public function getRules()
    {
        $rules = [
            'descripcion'=> 'required',
            'abreviatura'=> 'required',
            'categoria_id'=> ''
                  ];
        return $rules;
    }}
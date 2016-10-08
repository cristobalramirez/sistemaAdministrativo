<?php
namespace Salesfly\Salesfly\Managers;
class CursoManager extends BaseManager {

    public function getRules()
    {
        $rules = [
            'descripcion'=> 'required',
            'categoria_id'=> ''
                  ];
        return $rules;
    }}
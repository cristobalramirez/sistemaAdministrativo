<?php

namespace Salesfly\Salesfly\Managers;
class InscripcionManager extends BaseManager {
    public function getRules()
    {
        $rules = [  'fechaInscripcion',
                    'estado'=> '',
                    'montoCurso'=> '',
                    'montoPagado'=> '',
                    'saldo'=> '',
                    'medioPublicitario_id'=> '',
                    'persona_id'=> '',
                    'edicion_id'=> '',
                    'nombres'=>'',
                    'apellidos'=>'',
                    'dni' => '',
                    'email'=> '',
                    'telefono'=> ''
                  ];
        return $rules;
    }
} 
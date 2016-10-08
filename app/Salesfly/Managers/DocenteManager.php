<?php

namespace Salesfly\Salesfly\Managers;
class DocenteManager extends BaseManager {
    public function getRules()
    {
        $rules = [  
                    'nombres'=>'required',
                    'apellidos'=>'required',
                    'dni' => 'required',
                    'fechaNac'=> '',
                    'sexo' => '',
                    'curriculo' => '',
                    'gradoAcademico' => '',
                    'email'=> '',
                    'telefono'=> '',
                    'estado'=> '',
                    'ubigeo_id'=> '',
                    'profesion_id'=> '',
                    'pais_id'=> ''
                  ];
        return $rules;
    }
} 

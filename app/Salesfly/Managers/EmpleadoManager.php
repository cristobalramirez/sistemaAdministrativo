<?php

namespace Salesfly\Salesfly\Managers;
class EmpleadoManager extends BaseManager {
    public function getRules()
    {
        $rules = [  
                    'nombres'=>'required',
                    'apellidos'=>'required',
                    'dni' => 'required',
                    'fechaNac'=> '',
                    'fecIngreso'=> '',
                    'fecBaja'=> '',
                    'sexo' => '',
                    'email'=> '',
                    'telefono'=> '',
                    'estado'=> '',
                    'direccion'=> '',
                    'ubigeo_id'=> ''
                  ];
        return $rules;
    }
} 

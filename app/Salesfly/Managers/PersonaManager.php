<?php

namespace Salesfly\Salesfly\Managers;
class PersonaManager extends BaseManager {
    public function getRules()
    {
        $rules = [  
                    'nombres'=>'required',
                    'apellidos'=>'required',
                    'empresa' => '',
                    'dni' => 'required',
                    'fechaNac'=> '',
                    'sexo' => '',
                    'institucionTrabajo' => '',
                    'direccion' => '',
                    'email'=> '',
                    'telefono'=> '',
                    'estadoCivil'=> '',
                    'descripcionProfesion'=> '',
                    'estado'=> '',
                    'ubigeoTrabajo_id'=> '',
                    'ubigeoDireccion_id'=> '',
                    'profesion_id'=> '',
                    'pais_id'=> ''
                  ];
        return $rules;
    }
} 

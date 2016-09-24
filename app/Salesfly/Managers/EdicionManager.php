<?php

namespace Salesfly\Salesfly\Managers;
class EdicionManager extends BaseManager {
    public function getRules()
    {
        $rules = [  
                    'fechaInicio'=>'required',
                    'fechaFin'=>'required',
                    'costoCurso' => '',
                    'modalidad' => 'required',
                    'brochure'=> '',
                    'resolucion' => '',
                    'proyecto' => '',
                    'publicidadFace' => '',
                    'publicidadImprimir'=> '',
                    'curso_id'=> '',
                    'acreditadora_id'=> ''
                  ];
        return $rules;
    }
} 

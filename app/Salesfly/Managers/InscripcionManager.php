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
                    'descuentoPorcentaje'=> '',
                    'descuento'=> '',
                    'montoPagar'=> '',
                    'medioPublicitario_id'=> '',
                    'promocion_id'=> '',
                    'empleado_id'=> '',
                    'persona_id'=> '',
                    'edicion_id'=> '',
                    'nombres'=>'',
                    'apellidos'=>'',
                    'dni' => '',
                    'email'=> '',
                    'telefono'=> '',
                    'descripcion_promocion'=> ''
                  ];
        return $rules;
    }
} 
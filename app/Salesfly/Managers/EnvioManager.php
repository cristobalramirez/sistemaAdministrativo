<?php

namespace Salesfly\Salesfly\Managers;
class EnvioManager extends BaseManager {
    public function getRules()
    {
        $rules = [  'fechaCompromiso'=>'',
                    'descripcion'=>'',
                    'direccionAgencia'=>'',
                    'fechaEnvio'=>'',
                    'numeroFactura'=>'',
                    'clave'=>'',
                    'monto'=>'',
                    'agencia_id'=>'',
                    'inscripcion_id'=>'',
                    'ubigeo_id'=>''
                  ];
        return $rules;
    }
} 

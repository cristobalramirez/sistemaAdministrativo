<?php
namespace Salesfly\Salesfly\Managers;
class PagoManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'vaucher'=> '',
            'monto'=> '',
            'fechaPago'=> '',
            'cuentaBancaria_id'=> '',
            'inscripcion_id'=> ''
                  ];
        return $rules;
    }}
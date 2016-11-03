<?php
namespace Salesfly\Salesfly\Managers;
class SeguimientoInscripcionManager extends BaseManager {

    public function getRules()
    {
        $rules = ['estado'=> '',
    			'descripcion'=> '',
    			'fechaCompromiso'=> '',
    			'horaCompromiso'=> '',
    			'empleado_id'=> '',
    			'inscripcion_id'=> ''
                  ];
        return $rules;
    }}
<?php
namespace Salesfly\Salesfly\Entities;

class SeguimientoInscripcion extends \Eloquent {

	protected $table = 'seguimientoInscripciones';
    
    protected $fillable = ['estado',
    						'descripcion',
    						'fechaCompromiso',
    						'horaCompromiso',
    						'empleado_id',
    						'inscripcion_id'];

}
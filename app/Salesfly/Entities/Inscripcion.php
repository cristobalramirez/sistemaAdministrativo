<?php
namespace Salesfly\Salesfly\Entities;
class Inscripcion extends \Eloquent {
	protected $table = 'inscripciones';
    
    protected $fillable = ['fechaInscripcion',
                            'estado',
                            'montoCurso',
                            'montoPagado',
                            'saldo',
                            'descuentoPorcentaje',
                            'descuento',
                            'montoPagar',
                            'promocion_id',
                            'medioPublicitario_id',
                            'persona_id',
                            'edicion_id',
                            'empleado_id',
                            'nombres',
    						'apellidos',
    						'dni',
    						'email',
    						'telefono'
    						];
    }
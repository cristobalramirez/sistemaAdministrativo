<?php
namespace Salesfly\Salesfly\Entities;
class Inscripcion extends \Eloquent {
	protected $table = 'inscripciones';
    
    protected $fillable = ['fechaInscripcion',
                            'estado',
                            'montoCurso',
                            'montoPagado',
                            'saldo',
                            'medioPublicitario_id',
                            'persona_id',
                            'edicion_id',
                            'nombres',
    						'apellidos',
    						'dni',
    						'email',
    						'telefono'
    						];
    }
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

        public function persona(){
            return $this->belongsTo('Salesfly\Salesfly\Entities\Persona','persona_id');
        }
        public function edicion(){
            return $this->belongsTo('Salesfly\Salesfly\Entities\Edicion','edicion_id');
        }
    }
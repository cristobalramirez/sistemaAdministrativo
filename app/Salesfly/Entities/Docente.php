<?php
namespace Salesfly\Salesfly\Entities;
class Docente extends \Eloquent {
	protected $table = 'docentes';
    
    protected $fillable = ['nombres',
    						'apellidos',
    						'dni',
    						'fechaNac',
							'sexo',
    						'curriculo',
    						'gradoAcademico',
    						'email',
                            'telefono',
    						'estado',
    						'ubigeo_id',
    						'profesion_id',
                            'pais_id'
    						];
    public function ubigeo()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Ubigeo');
    }
}
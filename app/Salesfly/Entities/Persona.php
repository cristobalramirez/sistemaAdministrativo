<?php
namespace Salesfly\Salesfly\Entities;
class Persona extends \Eloquent {
	protected $table = 'personas';
    
    protected $fillable = ['nombres',
    						'apellidos',
    						'empresa',
    						'dni',
    						'fechaNac',
							'sexo',
    						'institucionTrabajo',
    						'direccion',
    						'email',
    						'telefono',
    						'estadoCivil',
    						'descripcionProfesion',
    						'estado',
    						'ubigeoTrabajo_id',
    						'ubigeoDireccion_id',
    						'profesion_id',
                            'pais_id',
                            'escala_id',
                            'especialidad_id'
    						];
    public function ubigeo()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Ubigeo');
    }
    public function persona(){
        return $this->belongsTo('Salesfly\Salesfly\Entities\Persona','persona_id');
    }
}
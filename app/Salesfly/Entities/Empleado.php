<?php
namespace Salesfly\Salesfly\Entities;
class Empleado extends \Eloquent {
	protected $table = 'empleados';
    
    protected $fillable = ['nombres',
    						'apellidos',
    						'dni',
    						'fechaNac',
                            'fecIngreso',
                            'fecBaja',
							'sexo',
    						'email',
                            'telefono',
    						'estado',
                            'direccion',
    						'ubigeo_id'
    						];
    public function ubigeo()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Ubigeo');
    }
}
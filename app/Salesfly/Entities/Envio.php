<?php
namespace Salesfly\Salesfly\Entities;
class Envio extends \Eloquent {
	protected $table = 'envios';
    
    protected $fillable = ['fechaCompromiso',
    						'descripcion',
    						'direccionAgencia',
    						'fechaEnvio',
							'numeroFactura',
    						'clave',
    						'monto',
    						'agencia_id',
                            'inscripcion_id',
    						'ubigeo_id'
    						];
    public function ubigeo()
    {
        return $this->belongsTo('\Salesfly\Salesfly\Entities\Ubigeo');
    }
}
<?php
namespace Salesfly\Salesfly\Entities;

class Pago extends \Eloquent {

	protected $table = 'pagos';
    
    protected $fillable = ['vaucher',
    						'monto',
            				'fechaPago',
            				'cuentaBancaria_id',
            				'inscripcion_id'];

}
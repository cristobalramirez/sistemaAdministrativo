<?php
namespace Salesfly\Salesfly\Entities;

class Promocion extends \Eloquent {

	protected $table = 'promociones';
    
    protected $fillable = ['descripcion',
    						'porcentajeDescuento'];
}
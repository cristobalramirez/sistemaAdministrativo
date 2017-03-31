<?php
namespace Salesfly\Salesfly\Entities;

class TipoComprobante extends \Eloquent {

	protected $table = 'tipo_comprobante';
    
    protected $fillable = ['descripcion','numero','estado'];
}
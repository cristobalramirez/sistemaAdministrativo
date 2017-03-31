<?php
namespace Salesfly\Salesfly\Entities;

class TipoGasto extends \Eloquent {

	protected $table = 'tipo_gasto';
    
    protected $fillable = ['descripcion','tipo','estado'];
}
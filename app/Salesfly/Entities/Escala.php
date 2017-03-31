<?php
namespace Salesfly\Salesfly\Entities;

class Escala extends \Eloquent {

	protected $table = 'escala';
    
    protected $fillable = ['descripcion','glosa','estado'];
}
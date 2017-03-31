<?php
namespace Salesfly\Salesfly\Entities;

class Especialidad extends \Eloquent {

	protected $table = 'especialidad';
    
    protected $fillable = ['descripcion','glosa','estado'];
}
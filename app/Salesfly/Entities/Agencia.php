<?php
namespace Salesfly\Salesfly\Entities;

class Agencia extends \Eloquent {

	protected $table = 'agencias';
    
    protected $fillable = ['nombre','descripcion'];

    
}
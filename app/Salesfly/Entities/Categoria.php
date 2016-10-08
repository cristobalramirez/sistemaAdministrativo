<?php
namespace Salesfly\Salesfly\Entities;

class Categoria extends \Eloquent {

	protected $table = 'categorias';
    
    protected $fillable = ['nombreCategoria','descripcion'];

    
}